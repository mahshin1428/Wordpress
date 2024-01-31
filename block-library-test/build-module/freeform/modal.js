import { createElement, Fragment } from "react";
/**
 * WordPress dependencies
 */
import { BlockControls, store } from '@wordpress/block-editor';
import { ToolbarGroup, ToolbarButton, Modal, Button, Flex, FlexItem } from '@wordpress/components';
import { useEffect, useState, RawHTML } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { fullscreen } from '@wordpress/icons';
import { useViewportMatch } from '@wordpress/compose';
function ModalAuxiliaryActions({
  onClick,
  isModalFullScreen
}) {
  // 'small' to match the rules in editor.scss.
  const isMobileViewport = useViewportMatch('small', '<');
  if (isMobileViewport) {
    return null;
  }
  return createElement(Button, {
    onClick: onClick,
    icon: fullscreen,
    isPressed: isModalFullScreen,
    label: isModalFullScreen ? __('Exit fullscreen') : __('Enter fullscreen')
  });
}
function ClassicEdit(props) {
  const styles = useSelect(select => select(store).getSettings().styles);
  useEffect(() => {
    const {
      baseURL,
      suffix,
      settings
    } = window.wpEditorL10n.tinymce;
    window.tinymce.EditorManager.overrideDefaults({
      base_url: baseURL,
      suffix
    });
    window.wp.oldEditor.initialize(props.id, {
      tinymce: {
        ...settings,
        setup(editor) {
          editor.on('init', () => {
            const doc = editor.getDoc();
            styles.forEach(({
              css
            }) => {
              const styleEl = doc.createElement('style');
              styleEl.innerHTML = css;
              doc.head.appendChild(styleEl);
            });
          });
        }
      }
    });
    return () => {
      window.wp.oldEditor.remove(props.id);
    };
  }, []);
  return createElement("textarea", {
    ...props
  });
}
export default function ModalEdit(props) {
  const {
    clientId,
    attributes: {
      content
    },
    setAttributes,
    onReplace
  } = props;
  const [isOpen, setOpen] = useState(false);
  const [isModalFullScreen, setIsModalFullScreen] = useState(false);
  const id = `editor-${clientId}`;
  const onClose = () => content ? setOpen(false) : onReplace([]);
  return createElement(Fragment, null, createElement(BlockControls, null, createElement(ToolbarGroup, null, createElement(ToolbarButton, {
    onClick: () => setOpen(true)
  }, __('Edit')))), content && createElement(RawHTML, null, content), (isOpen || !content) && createElement(Modal, {
    title: __('Classic Editor'),
    onRequestClose: onClose,
    shouldCloseOnClickOutside: false,
    overlayClassName: "block-editor-freeform-modal",
    isFullScreen: isModalFullScreen,
    className: "block-editor-freeform-modal__content",
    headerActions: createElement(ModalAuxiliaryActions, {
      onClick: () => setIsModalFullScreen(!isModalFullScreen),
      isModalFullScreen: isModalFullScreen
    })
  }, createElement(ClassicEdit, {
    id: id,
    defaultValue: content
  }), createElement(Flex, {
    className: "block-editor-freeform-modal__actions",
    justify: "flex-end",
    expanded: false
  }, createElement(FlexItem, null, createElement(Button, {
    variant: "tertiary",
    onClick: onClose
  }, __('Cancel'))), createElement(FlexItem, null, createElement(Button, {
    variant: "primary",
    onClick: () => {
      setAttributes({
        content: window.wp.oldEditor.getContent(id)
      });
      setOpen(false);
    }
  }, __('Save'))))));
}
//# sourceMappingURL=modal.js.map