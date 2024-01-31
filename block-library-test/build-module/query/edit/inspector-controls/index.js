import { createElement, Fragment } from "react";
/**
 * WordPress dependencies
 */
import { PanelBody, TextControl, SelectControl, RangeControl, ToggleControl, Notice, __experimentalToolsPanel as ToolsPanel, __experimentalToolsPanelItem as ToolsPanelItem } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { privateApis as blockEditorPrivateApis } from '@wordpress/block-editor';
import { debounce } from '@wordpress/compose';
import { useEffect, useState, useCallback } from '@wordpress/element';

/**
 * Internal dependencies
 */
import OrderControl from './order-control';
import AuthorControl from './author-control';
import ParentControl from './parent-control';
import { TaxonomyControls } from './taxonomy-controls';
import StickyControl from './sticky-control';
import EnhancedPaginationControl from './enhanced-pagination-control';
import CreateNewPostLink from './create-new-post-link';
import { unlock } from '../../../lock-unlock';
import { usePostTypes, useIsPostTypeHierarchical, useAllowedControls, isControlAllowed, useTaxonomies } from '../../utils';
import { TOOLSPANEL_DROPDOWNMENU_PROPS } from '../../../utils/constants';
const {
  BlockInfo
} = unlock(blockEditorPrivateApis);
export default function QueryInspectorControls(props) {
  const {
    attributes,
    setQuery,
    setDisplayLayout,
    setAttributes,
    clientId
  } = props;
  const {
    query,
    displayLayout,
    enhancedPagination
  } = attributes;
  const {
    order,
    orderBy,
    author: authorIds,
    postType,
    sticky,
    inherit,
    taxQuery,
    parents
  } = query;
  const allowedControls = useAllowedControls(attributes);
  const [showSticky, setShowSticky] = useState(postType === 'post');
  const {
    postTypesTaxonomiesMap,
    postTypesSelectOptions
  } = usePostTypes();
  const taxonomies = useTaxonomies(postType);
  const isPostTypeHierarchical = useIsPostTypeHierarchical(postType);
  useEffect(() => {
    setShowSticky(postType === 'post');
  }, [postType]);
  const onPostTypeChange = newValue => {
    const updateQuery = {
      postType: newValue
    };
    // We need to dynamically update the `taxQuery` property,
    // by removing any not supported taxonomy from the query.
    const supportedTaxonomies = postTypesTaxonomiesMap[newValue];
    const updatedTaxQuery = Object.entries(taxQuery || {}).reduce((accumulator, [taxonomySlug, terms]) => {
      if (supportedTaxonomies.includes(taxonomySlug)) {
        accumulator[taxonomySlug] = terms;
      }
      return accumulator;
    }, {});
    updateQuery.taxQuery = !!Object.keys(updatedTaxQuery).length ? updatedTaxQuery : undefined;
    if (newValue !== 'post') {
      updateQuery.sticky = '';
    }
    // We need to reset `parents` because they are tied to each post type.
    updateQuery.parents = [];
    setQuery(updateQuery);
  };
  const [querySearch, setQuerySearch] = useState(query.search);
  const onChangeDebounced = useCallback(debounce(() => {
    if (query.search !== querySearch) {
      setQuery({
        search: querySearch
      });
    }
  }, 250), [querySearch, query.search]);
  useEffect(() => {
    onChangeDebounced();
    return onChangeDebounced.cancel;
  }, [querySearch, onChangeDebounced]);
  const showInheritControl = isControlAllowed(allowedControls, 'inherit');
  const showPostTypeControl = !inherit && isControlAllowed(allowedControls, 'postType');
  const showColumnsControl = false;
  const showOrderControl = !inherit && isControlAllowed(allowedControls, 'order');
  const showStickyControl = !inherit && showSticky && isControlAllowed(allowedControls, 'sticky');
  const showSettingsPanel = showInheritControl || showPostTypeControl || showColumnsControl || showOrderControl || showStickyControl;
  const showTaxControl = !!taxonomies?.length && isControlAllowed(allowedControls, 'taxQuery');
  const showAuthorControl = isControlAllowed(allowedControls, 'author');
  const showSearchControl = isControlAllowed(allowedControls, 'search');
  const showParentControl = isControlAllowed(allowedControls, 'parents') && isPostTypeHierarchical;
  const showFiltersPanel = showTaxControl || showAuthorControl || showSearchControl || showParentControl;
  return createElement(Fragment, null, createElement(BlockInfo, null, createElement(CreateNewPostLink, {
    ...props
  })), showSettingsPanel && createElement(PanelBody, {
    title: __('Settings')
  }, showInheritControl && createElement(ToggleControl, {
    __nextHasNoMarginBottom: true,
    label: __('Inherit query from template'),
    help: __('Toggle to use the global query context that is set with the current template, such as an archive or search. Disable to customize the settings independently.'),
    checked: !!inherit,
    onChange: value => setQuery({
      inherit: !!value
    })
  }), showPostTypeControl && createElement(SelectControl, {
    __nextHasNoMarginBottom: true,
    options: postTypesSelectOptions,
    value: postType,
    label: __('Post type'),
    onChange: onPostTypeChange,
    help: __('WordPress contains different types of content and they are divided into collections called “Post types”. By default there are a few different ones such as blog posts and pages, but plugins could add more.')
  }), showColumnsControl && createElement(Fragment, null, createElement(RangeControl, {
    __nextHasNoMarginBottom: true,
    label: __('Columns'),
    value: displayLayout.columns,
    onChange: value => setDisplayLayout({
      columns: value
    }),
    min: 2,
    max: Math.max(6, displayLayout.columns)
  }), displayLayout.columns > 6 && createElement(Notice, {
    status: "warning",
    isDismissible: false
  }, __('This column count exceeds the recommended amount and may cause visual breakage.'))), showOrderControl && createElement(OrderControl, {
    order,
    orderBy,
    onChange: setQuery
  }), showStickyControl && createElement(StickyControl, {
    value: sticky,
    onChange: value => setQuery({
      sticky: value
    })
  }), createElement(EnhancedPaginationControl, {
    enhancedPagination: enhancedPagination,
    setAttributes: setAttributes,
    clientId: clientId
  })), !inherit && showFiltersPanel && createElement(ToolsPanel, {
    className: "block-library-query-toolspanel__filters",
    label: __('Filters'),
    resetAll: () => {
      setQuery({
        author: '',
        parents: [],
        search: '',
        taxQuery: null
      });
      setQuerySearch('');
    },
    dropdownMenuProps: TOOLSPANEL_DROPDOWNMENU_PROPS
  }, showTaxControl && createElement(ToolsPanelItem, {
    label: __('Taxonomies'),
    hasValue: () => Object.values(taxQuery || {}).some(terms => !!terms.length),
    onDeselect: () => setQuery({
      taxQuery: null
    })
  }, createElement(TaxonomyControls, {
    onChange: setQuery,
    query: query
  })), showAuthorControl && createElement(ToolsPanelItem, {
    hasValue: () => !!authorIds,
    label: __('Authors'),
    onDeselect: () => setQuery({
      author: ''
    })
  }, createElement(AuthorControl, {
    value: authorIds,
    onChange: setQuery
  })), showSearchControl && createElement(ToolsPanelItem, {
    hasValue: () => !!querySearch,
    label: __('Keyword'),
    onDeselect: () => setQuerySearch('')
  }, createElement(TextControl, {
    __nextHasNoMarginBottom: true,
    label: __('Keyword'),
    value: querySearch,
    onChange: setQuerySearch
  })), showParentControl && createElement(ToolsPanelItem, {
    hasValue: () => !!parents?.length,
    label: __('Parents'),
    onDeselect: () => setQuery({
      parents: []
    })
  }, createElement(ParentControl, {
    parents: parents,
    postType: postType,
    onChange: setQuery
  }))));
}
//# sourceMappingURL=index.js.map