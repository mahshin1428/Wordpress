import { createElement, Fragment } from "react";
/**
 * External dependencies
 */
import { TouchableWithoutFeedback } from 'react-native';

/**
 * WordPress dependencies
 */
import { View } from '@wordpress/primitives';
import { PanelBody, SelectControl, ToggleControl, ToolbarButton, ToolbarGroup, AudioPlayer } from '@wordpress/components';
import { BlockCaption, BlockControls, BlockIcon, InspectorControls, MediaPlaceholder, MediaUpload, MediaUploadProgress, RichText, store as blockEditorStore } from '@wordpress/block-editor';
import { __, _x, sprintf } from '@wordpress/i18n';
import { audio as icon, replace } from '@wordpress/icons';
import { useState } from '@wordpress/element';
import { useDispatch, useSelect } from '@wordpress/data';
import { store as noticesStore } from '@wordpress/notices';
import { isURL, getProtocol } from '@wordpress/url';

/**
 * Internal dependencies
 */
import styles from './style.scss';
const ALLOWED_MEDIA_TYPES = ['audio'];
function AudioEdit({
  attributes,
  setAttributes,
  isSelected,
  insertBlocksAfter,
  onFocus,
  onBlur,
  clientId
}) {
  const {
    id,
    autoplay,
    loop,
    preload,
    src
  } = attributes;
  const [isCaptionSelected, setIsCaptionSelected] = useState(false);
  const onFileChange = ({
    mediaId,
    mediaUrl
  }) => {
    setAttributes({
      id: mediaId,
      src: mediaUrl
    });
  };
  const {
    wasBlockJustInserted
  } = useSelect(select => ({
    wasBlockJustInserted: select(blockEditorStore).wasBlockJustInserted(clientId, 'inserter_menu')
  }));
  const {
    createErrorNotice
  } = useDispatch(noticesStore);
  function toggleAttribute(attribute) {
    return newValue => {
      setAttributes({
        [attribute]: newValue
      });
    };
  }
  function onSelectURL(newSrc) {
    if (newSrc !== src) {
      if (isURL(newSrc) && /^https?:/.test(getProtocol(newSrc))) {
        setAttributes({
          src: newSrc,
          id: undefined
        });
      } else {
        createErrorNotice(__('Invalid URL. Audio file not found.'));
      }
    }
  }
  function onSelectAudio(media) {
    if (!media || !media.url) {
      // In this case there was an error and we should continue in the editing state
      // previous attributes should be removed because they may be temporary blob urls.
      setAttributes({
        src: undefined,
        id: undefined
      });
      return;
    }
    // Sets the block's attribute and updates the edit component from the
    // selected media, then switches off the editing UI.
    setAttributes({
      src: media.url,
      id: media.id
    });
  }
  function onAudioPress() {
    setIsCaptionSelected(false);
  }
  function onFocusCaption() {
    if (!isCaptionSelected) {
      setIsCaptionSelected(true);
    }
  }
  if (!src) {
    return createElement(View, null, createElement(MediaPlaceholder, {
      icon: createElement(BlockIcon, {
        icon: icon
      }),
      onSelect: onSelectAudio,
      onSelectURL: onSelectURL,
      accept: "audio/*",
      allowedTypes: ALLOWED_MEDIA_TYPES,
      value: attributes,
      onFocus: onFocus,
      autoOpenMediaUpload: isSelected && wasBlockJustInserted
    }));
  }
  function getBlockControls(open) {
    return createElement(BlockControls, null, createElement(ToolbarGroup, null, createElement(ToolbarButton, {
      title: __('Replace audio'),
      icon: replace,
      onClick: open
    })));
  }
  function getBlockUI(open, getMediaOptions) {
    return createElement(MediaUploadProgress, {
      mediaId: id,
      onFinishMediaUploadWithSuccess: onFileChange,
      onMediaUploadStateReset: onFileChange,
      containerStyle: styles.progressContainer,
      progressBarStyle: styles.progressBar,
      spinnerStyle: styles.spinner,
      renderContent: ({
        isUploadInProgress,
        isUploadFailed,
        retryMessage
      }) => {
        return createElement(Fragment, null, !isCaptionSelected && !isUploadInProgress && getBlockControls(open), getMediaOptions(), createElement(AudioPlayer, {
          isUploadInProgress: isUploadInProgress,
          isUploadFailed: isUploadFailed,
          retryMessage: retryMessage,
          attributes: attributes,
          isSelected: isSelected
        }));
      }
    });
  }
  return createElement(TouchableWithoutFeedback, {
    accessible: !isSelected,
    onPress: onAudioPress,
    disabled: !isSelected
  }, createElement(View, null, createElement(InspectorControls, null, createElement(PanelBody, {
    title: __('Settings')
  }, createElement(ToggleControl, {
    label: __('Autoplay'),
    onChange: toggleAttribute('autoplay'),
    checked: autoplay,
    help: __('Autoplay may cause usability issues for some users.')
  }), createElement(ToggleControl, {
    label: __('Loop'),
    onChange: toggleAttribute('loop'),
    checked: loop
  }), createElement(SelectControl, {
    label: _x('Preload', 'noun; Audio block parameter'),
    value: preload || ''
    // `undefined` is required for the preload attribute to be unset.
    ,
    onChange: value => setAttributes({
      preload: value || undefined
    }),
    options: [{
      value: '',
      label: __('Browser default')
    }, {
      value: 'auto',
      label: __('Auto')
    }, {
      value: 'metadata',
      label: __('Metadata')
    }, {
      value: 'none',
      label: _x('None', '"Preload" value')
    }],
    hideCancelButton: true
  }))), createElement(MediaUpload, {
    allowedTypes: ALLOWED_MEDIA_TYPES,
    isReplacingMedia: true,
    onSelect: onSelectAudio,
    onSelectURL: onSelectURL,
    render: ({
      open,
      getMediaOptions
    }) => {
      return getBlockUI(open, getMediaOptions);
    }
  }), createElement(BlockCaption, {
    accessible: true,
    accessibilityLabelCreator: caption => RichText.isEmpty(caption) ? /* translators: accessibility text. Empty Audio caption. */
    __('Audio caption. Empty') : sprintf( /* translators: accessibility text. %s: Audio caption. */
    __('Audio caption. %s'), caption),
    clientId: clientId,
    isSelected: isCaptionSelected,
    onFocus: onFocusCaption,
    onBlur: onBlur,
    insertBlocksAfter: insertBlocksAfter
  })));
}
export default AudioEdit;
//# sourceMappingURL=edit.native.js.map