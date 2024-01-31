import { createElement, Fragment } from "react";
/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { useDispatch, useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { AlignmentControl, useBlockProps, BlockControls, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { createBlock, getDefaultBlockName } from '@wordpress/blocks';
export default function SiteTaglineEdit({
  attributes,
  setAttributes,
  insertBlocksAfter
}) {
  const {
    textAlign
  } = attributes;
  const {
    canUserEdit,
    tagline
  } = useSelect(select => {
    const {
      canUser,
      getEntityRecord,
      getEditedEntityRecord
    } = select(coreStore);
    const canEdit = canUser('update', 'settings');
    const settings = canEdit ? getEditedEntityRecord('root', 'site') : {};
    const readOnlySettings = getEntityRecord('root', '__unstableBase');
    return {
      canUserEdit: canUser('update', 'settings'),
      tagline: canEdit ? settings?.description : readOnlySettings?.description
    };
  }, []);
  const {
    editEntityRecord
  } = useDispatch(coreStore);
  function setTagline(newTagline) {
    editEntityRecord('root', 'site', undefined, {
      description: newTagline
    });
  }
  const blockProps = useBlockProps({
    className: classnames({
      [`has-text-align-${textAlign}`]: textAlign,
      'wp-block-site-tagline__placeholder': !canUserEdit && !tagline
    })
  });
  const siteTaglineContent = canUserEdit ? createElement(RichText, {
    allowedFormats: [],
    onChange: setTagline,
    "aria-label": __('Site tagline text'),
    placeholder: __('Write site tagline…'),
    tagName: "p",
    value: tagline,
    disableLineBreaks: true,
    __unstableOnSplitAtEnd: () => insertBlocksAfter(createBlock(getDefaultBlockName())),
    ...blockProps
  }) : createElement("p", {
    ...blockProps
  }, tagline || __('Site Tagline placeholder'));
  return createElement(Fragment, null, createElement(BlockControls, {
    group: "block"
  }, createElement(AlignmentControl, {
    onChange: newAlign => setAttributes({
      textAlign: newAlign
    }),
    value: textAlign
  })), siteTaglineContent);
}
//# sourceMappingURL=edit.js.map