import { createElement, Fragment } from "react";
/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { AlignmentControl, BlockControls, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { store as coreStore } from '@wordpress/core-data';
import { PanelBody, ToggleControl } from '@wordpress/components';
function PostAuthorNameEdit({
  context: {
    postType,
    postId
  },
  attributes: {
    textAlign,
    isLink,
    linkTarget
  },
  setAttributes
}) {
  const {
    authorName
  } = useSelect(select => {
    const {
      getEditedEntityRecord,
      getUser
    } = select(coreStore);
    const _authorId = getEditedEntityRecord('postType', postType, postId)?.author;
    return {
      authorName: _authorId ? getUser(_authorId) : null
    };
  }, [postType, postId]);
  const blockProps = useBlockProps({
    className: classnames({
      [`has-text-align-${textAlign}`]: textAlign
    })
  });
  const displayName = authorName?.name || __('Author Name');
  const displayAuthor = isLink ? createElement("a", {
    href: "#author-pseudo-link",
    onClick: event => event.preventDefault(),
    className: "wp-block-post-author-name__link"
  }, displayName) : displayName;
  return createElement(Fragment, null, createElement(BlockControls, {
    group: "block"
  }, createElement(AlignmentControl, {
    value: textAlign,
    onChange: nextAlign => {
      setAttributes({
        textAlign: nextAlign
      });
    }
  })), createElement(InspectorControls, null, createElement(PanelBody, {
    title: __('Settings')
  }, createElement(ToggleControl, {
    __nextHasNoMarginBottom: true,
    label: __('Link to author archive'),
    onChange: () => setAttributes({
      isLink: !isLink
    }),
    checked: isLink
  }), isLink && createElement(ToggleControl, {
    __nextHasNoMarginBottom: true,
    label: __('Open in new tab'),
    onChange: value => setAttributes({
      linkTarget: value ? '_blank' : '_self'
    }),
    checked: linkTarget === '_blank'
  }))), createElement("div", {
    ...blockProps
  }, " ", displayAuthor, " "));
}
export default PostAuthorNameEdit;
//# sourceMappingURL=edit.js.map