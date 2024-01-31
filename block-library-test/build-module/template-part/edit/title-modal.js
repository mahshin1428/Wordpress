import { createElement } from "react";
/**
 * WordPress dependencies
 */
import { useState } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { TextControl, Button, Modal, __experimentalHStack as HStack, __experimentalVStack as VStack } from '@wordpress/components';
export default function TitleModal({
  areaLabel,
  onClose,
  onSubmit
}) {
  // Restructure onCreate to set the blocks on local state.
  // Add modal to confirm title and trigger onCreate.
  const [title, setTitle] = useState(__('Untitled Template Part'));
  const submitForCreation = event => {
    event.preventDefault();
    onSubmit(title);
  };
  return createElement(Modal, {
    title: sprintf(
    // Translators: %s as template part area title ("Header", "Footer", etc.).
    __('Name and create your new %s'), areaLabel.toLowerCase()),
    overlayClassName: "wp-block-template-part__placeholder-create-new__title-form",
    onRequestClose: onClose
  }, createElement("form", {
    onSubmit: submitForCreation
  }, createElement(VStack, {
    spacing: "5"
  }, createElement(TextControl, {
    __nextHasNoMarginBottom: true,
    label: __('Name'),
    value: title,
    onChange: setTitle
  }), createElement(HStack, {
    justify: "right"
  }, createElement(Button, {
    variant: "primary",
    type: "submit",
    disabled: !title.length,
    "aria-disabled": !title.length
  }, __('Create'))))));
}
//# sourceMappingURL=title-modal.js.map