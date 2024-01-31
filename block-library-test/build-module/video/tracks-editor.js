import { createElement, Fragment } from "react";
/**
 * WordPress dependencies
 */
import { __, sprintf } from '@wordpress/i18n';
import { NavigableMenu, MenuItem, FormFileUpload, MenuGroup, ToolbarGroup, ToolbarButton, Dropdown, Button, TextControl, SelectControl, __experimentalGrid as Grid, __experimentalHStack as HStack, __experimentalVStack as VStack } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck, store as blockEditorStore } from '@wordpress/block-editor';
import { upload, media } from '@wordpress/icons';
import { useSelect } from '@wordpress/data';
import { useState } from '@wordpress/element';
import { getFilename } from '@wordpress/url';
const ALLOWED_TYPES = ['text/vtt'];
const DEFAULT_KIND = 'subtitles';
const KIND_OPTIONS = [{
  label: __('Subtitles'),
  value: 'subtitles'
}, {
  label: __('Captions'),
  value: 'captions'
}, {
  label: __('Descriptions'),
  value: 'descriptions'
}, {
  label: __('Chapters'),
  value: 'chapters'
}, {
  label: __('Metadata'),
  value: 'metadata'
}];
function TrackList({
  tracks,
  onEditPress
}) {
  let content;
  if (tracks.length === 0) {
    content = createElement("p", {
      className: "block-library-video-tracks-editor__tracks-informative-message"
    }, __('Tracks can be subtitles, captions, chapters, or descriptions. They help make your content more accessible to a wider range of users.'));
  } else {
    content = tracks.map((track, index) => {
      return createElement(HStack, {
        key: index,
        className: "block-library-video-tracks-editor__track-list-track"
      }, createElement("span", null, track.label, " "), createElement(Button, {
        variant: "tertiary",
        onClick: () => onEditPress(index),
        "aria-label": sprintf( /* translators: %s: Label of the video text track e.g: "French subtitles" */
        __('Edit %s'), track.label)
      }, __('Edit')));
    });
  }
  return createElement(MenuGroup, {
    label: __('Text tracks'),
    className: "block-library-video-tracks-editor__track-list"
  }, content);
}
function SingleTrackEditor({
  track,
  onChange,
  onClose,
  onRemove
}) {
  const {
    src = '',
    label = '',
    srcLang = '',
    kind = DEFAULT_KIND
  } = track;
  const fileName = src.startsWith('blob:') ? '' : getFilename(src) || '';
  return createElement(NavigableMenu, null, createElement(VStack, {
    className: "block-library-video-tracks-editor__single-track-editor",
    spacing: "4"
  }, createElement("span", {
    className: "block-library-video-tracks-editor__single-track-editor-edit-track-label"
  }, __('Edit track')), createElement("span", null, __('File'), ": ", createElement("b", null, fileName)), createElement(Grid, {
    columns: 2,
    gap: 4
  }, createElement(TextControl, {
    __nextHasNoMarginBottom: true
    /* eslint-disable jsx-a11y/no-autofocus */,
    autoFocus: true
    /* eslint-enable jsx-a11y/no-autofocus */,
    onChange: newLabel => onChange({
      ...track,
      label: newLabel
    }),
    label: __('Label'),
    value: label,
    help: __('Title of track')
  }), createElement(TextControl, {
    __nextHasNoMarginBottom: true,
    onChange: newSrcLang => onChange({
      ...track,
      srcLang: newSrcLang
    }),
    label: __('Source language'),
    value: srcLang,
    help: __('Language tag (en, fr, etc.)')
  })), createElement(VStack, {
    spacing: "8"
  }, createElement(SelectControl, {
    __nextHasNoMarginBottom: true,
    className: "block-library-video-tracks-editor__single-track-editor-kind-select",
    options: KIND_OPTIONS,
    value: kind,
    label: __('Kind'),
    onChange: newKind => {
      onChange({
        ...track,
        kind: newKind
      });
    }
  }), createElement(HStack, {
    className: "block-library-video-tracks-editor__single-track-editor-buttons-container"
  }, createElement(Button, {
    variant: "secondary",
    onClick: () => {
      const changes = {};
      let hasChanges = false;
      if (label === '') {
        changes.label = __('English');
        hasChanges = true;
      }
      if (srcLang === '') {
        changes.srcLang = 'en';
        hasChanges = true;
      }
      if (track.kind === undefined) {
        changes.kind = DEFAULT_KIND;
        hasChanges = true;
      }
      if (hasChanges) {
        onChange({
          ...track,
          ...changes
        });
      }
      onClose();
    }
  }, __('Close')), createElement(Button, {
    isDestructive: true,
    variant: "link",
    onClick: onRemove
  }, __('Remove track'))))));
}
export default function TracksEditor({
  tracks = [],
  onChange
}) {
  const mediaUpload = useSelect(select => {
    return select(blockEditorStore).getSettings().mediaUpload;
  }, []);
  const [trackBeingEdited, setTrackBeingEdited] = useState(null);
  if (!mediaUpload) {
    return null;
  }
  return createElement(Dropdown, {
    contentClassName: "block-library-video-tracks-editor",
    renderToggle: ({
      isOpen,
      onToggle
    }) => createElement(ToolbarGroup, null, createElement(ToolbarButton, {
      label: __('Text tracks'),
      showTooltip: true,
      "aria-expanded": isOpen,
      "aria-haspopup": "true",
      onClick: onToggle
    }, __('Text tracks'))),
    renderContent: () => {
      if (trackBeingEdited !== null) {
        return createElement(SingleTrackEditor, {
          track: tracks[trackBeingEdited],
          onChange: newTrack => {
            const newTracks = [...tracks];
            newTracks[trackBeingEdited] = newTrack;
            onChange(newTracks);
          },
          onClose: () => setTrackBeingEdited(null),
          onRemove: () => {
            onChange(tracks.filter((_track, index) => index !== trackBeingEdited));
            setTrackBeingEdited(null);
          }
        });
      }
      return createElement(Fragment, null, createElement(NavigableMenu, null, createElement(TrackList, {
        tracks: tracks,
        onEditPress: setTrackBeingEdited
      }), createElement(MenuGroup, {
        className: "block-library-video-tracks-editor__add-tracks-container",
        label: __('Add tracks')
      }, createElement(MediaUpload, {
        onSelect: ({
          url
        }) => {
          const trackIndex = tracks.length;
          onChange([...tracks, {
            src: url
          }]);
          setTrackBeingEdited(trackIndex);
        },
        allowedTypes: ALLOWED_TYPES,
        render: ({
          open
        }) => createElement(MenuItem, {
          icon: media,
          onClick: open
        }, __('Open Media Library'))
      }), createElement(MediaUploadCheck, null, createElement(FormFileUpload, {
        onChange: event => {
          const files = event.target.files;
          const trackIndex = tracks.length;
          mediaUpload({
            allowedTypes: ALLOWED_TYPES,
            filesList: files,
            onFileChange: ([{
              url
            }]) => {
              const newTracks = [...tracks];
              if (!newTracks[trackIndex]) {
                newTracks[trackIndex] = {};
              }
              newTracks[trackIndex] = {
                ...tracks[trackIndex],
                src: url
              };
              onChange(newTracks);
              setTrackBeingEdited(trackIndex);
            }
          });
        },
        accept: ".vtt,text/vtt",
        render: ({
          openFileDialog
        }) => {
          return createElement(MenuItem, {
            icon: upload,
            onClick: () => {
              openFileDialog();
            }
          }, __('Upload'));
        }
      })))));
    }
  });
}
//# sourceMappingURL=tracks-editor.js.map