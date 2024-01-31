"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");
Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = LogoEdit;
var _react = require("react");
var _classnames = _interopRequireDefault(require("classnames"));
var _blob = require("@wordpress/blob");
var _element = require("@wordpress/element");
var _i18n = require("@wordpress/i18n");
var _components = require("@wordpress/components");
var _compose = require("@wordpress/compose");
var _blockEditor = require("@wordpress/block-editor");
var _data = require("@wordpress/data");
var _coreData = require("@wordpress/core-data");
var _icons = require("@wordpress/icons");
var _notices = require("@wordpress/notices");
var _useClientWidth = _interopRequireDefault(require("../image/use-client-width"));
var _constants = require("../image/constants");
/**
 * External dependencies
 */

/**
 * WordPress dependencies
 */

/**
 * Internal dependencies
 */

/**
 * Module constants
 */

const ALLOWED_MEDIA_TYPES = ['image'];
const ACCEPT_MEDIA_STRING = 'image/*';
const SiteLogo = ({
  alt,
  attributes: {
    align,
    width,
    height,
    isLink,
    linkTarget,
    shouldSyncIcon
  },
  containerRef,
  isSelected,
  setAttributes,
  setLogo,
  logoUrl,
  siteUrl,
  logoId,
  iconId,
  setIcon,
  canUserEdit
}) => {
  const clientWidth = (0, _useClientWidth.default)(containerRef, [align]);
  const isLargeViewport = (0, _compose.useViewportMatch)('medium');
  const isWideAligned = ['wide', 'full'].includes(align);
  const isResizable = !isWideAligned && isLargeViewport;
  const [{
    naturalWidth,
    naturalHeight
  }, setNaturalSize] = (0, _element.useState)({});
  const [isEditingImage, setIsEditingImage] = (0, _element.useState)(false);
  const {
    toggleSelection
  } = (0, _data.useDispatch)(_blockEditor.store);
  const classes = (0, _classnames.default)('custom-logo-link', {
    'is-transient': (0, _blob.isBlobURL)(logoUrl)
  });
  const {
    imageEditing,
    maxWidth,
    title
  } = (0, _data.useSelect)(select => {
    const settings = select(_blockEditor.store).getSettings();
    const siteEntities = select(_coreData.store).getEntityRecord('root', '__unstableBase');
    return {
      title: siteEntities?.name,
      imageEditing: settings.imageEditing,
      maxWidth: settings.maxWidth
    };
  }, []);
  (0, _element.useEffect)(() => {
    // Turn the `Use as site icon` toggle off if it is on but the logo and icon have
    // fallen out of sync. This can happen if the toggle is saved in the `on` position,
    // but changes are later made to the site icon in the Customizer.
    if (shouldSyncIcon && logoId !== iconId) {
      setAttributes({
        shouldSyncIcon: false
      });
    }
  }, []);
  (0, _element.useEffect)(() => {
    if (!isSelected) {
      setIsEditingImage(false);
    }
  }, [isSelected]);
  function onResizeStart() {
    toggleSelection(false);
  }
  function onResizeStop() {
    toggleSelection(true);
  }
  const img = (0, _react.createElement)("img", {
    className: "custom-logo",
    src: logoUrl,
    alt: alt,
    onLoad: event => {
      setNaturalSize({
        naturalWidth: event.target.naturalWidth,
        naturalHeight: event.target.naturalHeight
      });
    }
  });
  let imgWrapper = img;

  // Disable reason: Image itself is not meant to be interactive, but
  // should direct focus to block.
  if (isLink) {
    imgWrapper = /* eslint-disable jsx-a11y/no-noninteractive-element-interactions, jsx-a11y/click-events-have-key-events */
    (0, _react.createElement)("a", {
      href: siteUrl,
      className: classes,
      rel: "home",
      title: title,
      onClick: event => event.preventDefault()
    }, img)
    /* eslint-enable jsx-a11y/no-noninteractive-element-interactions, jsx-a11y/click-events-have-key-events */;
  }
  let imageWidthWithinContainer;
  if (clientWidth && naturalWidth && naturalHeight) {
    const exceedMaxWidth = naturalWidth > clientWidth;
    imageWidthWithinContainer = exceedMaxWidth ? clientWidth : naturalWidth;
  }
  if (!isResizable || !imageWidthWithinContainer) {
    return (0, _react.createElement)("div", {
      style: {
        width,
        height
      }
    }, imgWrapper);
  }

  // Set the default width to a responsible size.
  // Note that this width is also set in the attached frontend CSS file.
  const defaultWidth = 120;
  const currentWidth = width || defaultWidth;
  const ratio = naturalWidth / naturalHeight;
  const currentHeight = currentWidth / ratio;
  const minWidth = naturalWidth < naturalHeight ? _constants.MIN_SIZE : Math.ceil(_constants.MIN_SIZE * ratio);
  const minHeight = naturalHeight < naturalWidth ? _constants.MIN_SIZE : Math.ceil(_constants.MIN_SIZE / ratio);

  // With the current implementation of ResizableBox, an image needs an
  // explicit pixel value for the max-width. In absence of being able to
  // set the content-width, this max-width is currently dictated by the
  // vanilla editor style. The following variable adds a buffer to this
  // vanilla style, so 3rd party themes have some wiggleroom. This does,
  // in most cases, allow you to scale the image beyond the width of the
  // main column, though not infinitely.
  // @todo It would be good to revisit this once a content-width variable
  // becomes available.
  const maxWidthBuffer = maxWidth * 2.5;
  let showRightHandle = false;
  let showLeftHandle = false;

  /* eslint-disable no-lonely-if */
  // See https://github.com/WordPress/gutenberg/issues/7584.
  if (align === 'center') {
    // When the image is centered, show both handles.
    showRightHandle = true;
    showLeftHandle = true;
  } else if ((0, _i18n.isRTL)()) {
    // In RTL mode the image is on the right by default.
    // Show the right handle and hide the left handle only when it is
    // aligned left. Otherwise always show the left handle.
    if (align === 'left') {
      showRightHandle = true;
    } else {
      showLeftHandle = true;
    }
  } else {
    // Show the left handle and hide the right handle only when the
    // image is aligned right. Otherwise always show the right handle.
    if (align === 'right') {
      showLeftHandle = true;
    } else {
      showRightHandle = true;
    }
  }
  /* eslint-enable no-lonely-if */

  const canEditImage = logoId && naturalWidth && naturalHeight && imageEditing;
  const imgEdit = canEditImage && isEditingImage ? (0, _react.createElement)(_blockEditor.__experimentalImageEditor, {
    id: logoId,
    url: logoUrl,
    width: currentWidth,
    height: currentHeight,
    clientWidth: clientWidth,
    naturalHeight: naturalHeight,
    naturalWidth: naturalWidth,
    onSaveImage: imageAttributes => {
      setLogo(imageAttributes.id);
    },
    onFinishEditing: () => {
      setIsEditingImage(false);
    }
  }) : (0, _react.createElement)(_components.ResizableBox, {
    size: {
      width: currentWidth,
      height: currentHeight
    },
    showHandle: isSelected,
    minWidth: minWidth,
    maxWidth: maxWidthBuffer,
    minHeight: minHeight,
    maxHeight: maxWidthBuffer / ratio,
    lockAspectRatio: true,
    enable: {
      top: false,
      right: showRightHandle,
      bottom: true,
      left: showLeftHandle
    },
    onResizeStart: onResizeStart,
    onResizeStop: (event, direction, elt, delta) => {
      onResizeStop();
      setAttributes({
        width: parseInt(currentWidth + delta.width, 10),
        height: parseInt(currentHeight + delta.height, 10)
      });
    }
  }, imgWrapper);
  const syncSiteIconHelpText = (0, _element.createInterpolateElement)((0, _i18n.__)('Site Icons are what you see in browser tabs, bookmark bars, and within the WordPress mobile apps. To use a custom icon that is different from your site logo, use the <a>Site Icon settings</a>.'), {
    a:
    // eslint-disable-next-line jsx-a11y/anchor-has-content
    (0, _react.createElement)("a", {
      href: siteUrl + '/wp-admin/customize.php?autofocus[section]=title_tagline',
      target: "_blank",
      rel: "noopener noreferrer"
    })
  });
  return (0, _react.createElement)(_react.Fragment, null, (0, _react.createElement)(_blockEditor.InspectorControls, null, (0, _react.createElement)(_components.PanelBody, {
    title: (0, _i18n.__)('Settings')
  }, (0, _react.createElement)(_components.RangeControl, {
    __nextHasNoMarginBottom: true,
    __next40pxDefaultSize: true,
    label: (0, _i18n.__)('Image width'),
    onChange: newWidth => setAttributes({
      width: newWidth
    }),
    min: minWidth,
    max: maxWidthBuffer,
    initialPosition: Math.min(defaultWidth, maxWidthBuffer),
    value: width || '',
    disabled: !isResizable
  }), (0, _react.createElement)(_components.ToggleControl, {
    __nextHasNoMarginBottom: true,
    label: (0, _i18n.__)('Link image to home'),
    onChange: () => setAttributes({
      isLink: !isLink
    }),
    checked: isLink
  }), isLink && (0, _react.createElement)(_react.Fragment, null, (0, _react.createElement)(_components.ToggleControl, {
    __nextHasNoMarginBottom: true,
    label: (0, _i18n.__)('Open in new tab'),
    onChange: value => setAttributes({
      linkTarget: value ? '_blank' : '_self'
    }),
    checked: linkTarget === '_blank'
  })), canUserEdit && (0, _react.createElement)(_react.Fragment, null, (0, _react.createElement)(_components.ToggleControl, {
    __nextHasNoMarginBottom: true,
    label: (0, _i18n.__)('Use as site icon'),
    onChange: value => {
      setAttributes({
        shouldSyncIcon: value
      });
      setIcon(value ? logoId : undefined);
    },
    checked: !!shouldSyncIcon,
    help: syncSiteIconHelpText
  })))), (0, _react.createElement)(_blockEditor.BlockControls, {
    group: "block"
  }, canEditImage && !isEditingImage && (0, _react.createElement)(_components.ToolbarButton, {
    onClick: () => setIsEditingImage(true),
    icon: _icons.crop,
    label: (0, _i18n.__)('Crop')
  })), imgEdit);
};

// This is a light wrapper around MediaReplaceFlow because the block has two
// different MediaReplaceFlows, one for the inspector and one for the toolbar.
function SiteLogoReplaceFlow({
  onRemoveLogo,
  ...mediaReplaceProps
}) {
  return (0, _react.createElement)(_blockEditor.MediaReplaceFlow, {
    ...mediaReplaceProps,
    allowedTypes: ALLOWED_MEDIA_TYPES,
    accept: ACCEPT_MEDIA_STRING
  }, (0, _react.createElement)(_components.MenuItem, {
    onClick: onRemoveLogo
  }, (0, _i18n.__)('Reset')));
}
const InspectorLogoPreview = ({
  mediaItemData = {},
  itemGroupProps
}) => {
  const {
    alt_text: alt,
    source_url: logoUrl,
    slug: logoSlug,
    media_details: logoMediaDetails
  } = mediaItemData;
  const logoLabel = logoMediaDetails?.sizes?.full?.file || logoSlug;
  return (0, _react.createElement)(_components.__experimentalItemGroup, {
    ...itemGroupProps,
    as: "span"
  }, (0, _react.createElement)(_components.__experimentalHStack, {
    justify: "flex-start",
    as: "span"
  }, (0, _react.createElement)("img", {
    src: logoUrl,
    alt: alt
  }), (0, _react.createElement)(_components.FlexItem, {
    as: "span"
  }, (0, _react.createElement)(_components.__experimentalTruncate, {
    numberOfLines: 1,
    className: "block-library-site-logo__inspector-media-replace-title"
  }, logoLabel))));
};
function LogoEdit({
  attributes,
  className,
  setAttributes,
  isSelected
}) {
  const {
    width,
    shouldSyncIcon
  } = attributes;
  const ref = (0, _element.useRef)();
  const {
    siteLogoId,
    canUserEdit,
    url,
    siteIconId,
    mediaItemData,
    isRequestingMediaItem
  } = (0, _data.useSelect)(select => {
    const {
      canUser,
      getEntityRecord,
      getEditedEntityRecord
    } = select(_coreData.store);
    const _canUserEdit = canUser('update', 'settings');
    const siteSettings = _canUserEdit ? getEditedEntityRecord('root', 'site') : undefined;
    const siteData = getEntityRecord('root', '__unstableBase');
    const _siteLogoId = _canUserEdit ? siteSettings?.site_logo : siteData?.site_logo;
    const _siteIconId = siteSettings?.site_icon;
    const mediaItem = _siteLogoId && select(_coreData.store).getMedia(_siteLogoId, {
      context: 'view'
    });
    const _isRequestingMediaItem = _siteLogoId && !select(_coreData.store).hasFinishedResolution('getMedia', [_siteLogoId, {
      context: 'view'
    }]);
    return {
      siteLogoId: _siteLogoId,
      canUserEdit: _canUserEdit,
      url: siteData?.home,
      mediaItemData: mediaItem,
      isRequestingMediaItem: _isRequestingMediaItem,
      siteIconId: _siteIconId
    };
  }, []);
  const {
    getSettings
  } = (0, _data.useSelect)(_blockEditor.store);
  const {
    editEntityRecord
  } = (0, _data.useDispatch)(_coreData.store);
  const setLogo = (newValue, shouldForceSync = false) => {
    // `shouldForceSync` is used to force syncing when the attribute
    // may not have updated yet.
    if (shouldSyncIcon || shouldForceSync) {
      setIcon(newValue);
    }
    editEntityRecord('root', 'site', undefined, {
      site_logo: newValue
    });
  };
  const setIcon = newValue =>
  // The new value needs to be `null` to reset the Site Icon.
  editEntityRecord('root', 'site', undefined, {
    site_icon: newValue !== null && newValue !== void 0 ? newValue : null
  });
  const {
    alt_text: alt,
    source_url: logoUrl
  } = mediaItemData !== null && mediaItemData !== void 0 ? mediaItemData : {};
  const onInitialSelectLogo = media => {
    // Initialize the syncSiteIcon toggle. If we currently have no Site logo and no
    // site icon, automatically sync the logo to the icon.
    if (shouldSyncIcon === undefined) {
      const shouldForceSync = !siteIconId;
      setAttributes({
        shouldSyncIcon: shouldForceSync
      });

      // Because we cannot rely on the `shouldSyncIcon` attribute to have updated by
      // the time `setLogo` is called, pass an argument to force the syncing.
      onSelectLogo(media, shouldForceSync);
      return;
    }
    onSelectLogo(media);
  };
  const onSelectLogo = (media, shouldForceSync = false) => {
    if (!media) {
      return;
    }
    if (!media.id && media.url) {
      // This is a temporary blob image.
      setLogo(undefined);
      return;
    }
    setLogo(media.id, shouldForceSync);
  };
  const onRemoveLogo = () => {
    setLogo(null);
    setAttributes({
      width: undefined
    });
  };
  const {
    createErrorNotice
  } = (0, _data.useDispatch)(_notices.store);
  const onUploadError = message => {
    createErrorNotice(message, {
      type: 'snackbar'
    });
  };
  const onFilesDrop = filesList => {
    getSettings().mediaUpload({
      allowedTypes: ALLOWED_MEDIA_TYPES,
      filesList,
      onFileChange([image]) {
        if ((0, _blob.isBlobURL)(image?.url)) {
          return;
        }
        onInitialSelectLogo(image);
      },
      onError: onUploadError
    });
  };
  const mediaReplaceFlowProps = {
    mediaURL: logoUrl,
    onSelect: onSelectLogo,
    onError: onUploadError,
    onRemoveLogo
  };
  const controls = canUserEdit && logoUrl && (0, _react.createElement)(_blockEditor.BlockControls, {
    group: "other"
  }, (0, _react.createElement)(SiteLogoReplaceFlow, {
    ...mediaReplaceFlowProps
  }));
  let logoImage;
  const isLoading = siteLogoId === undefined || isRequestingMediaItem;
  if (isLoading) {
    logoImage = (0, _react.createElement)(_components.Spinner, null);
  }
  if (!!logoUrl) {
    logoImage = (0, _react.createElement)(SiteLogo, {
      alt: alt,
      attributes: attributes,
      className: className,
      containerRef: ref,
      isSelected: isSelected,
      setAttributes: setAttributes,
      logoUrl: logoUrl,
      setLogo: setLogo,
      logoId: mediaItemData?.id || siteLogoId,
      siteUrl: url,
      setIcon: setIcon,
      iconId: siteIconId,
      canUserEdit: canUserEdit
    });
  }
  const placeholder = content => {
    const placeholderClassName = (0, _classnames.default)('block-editor-media-placeholder', className);
    return (0, _react.createElement)(_components.Placeholder, {
      className: placeholderClassName,
      preview: logoImage,
      withIllustration: true,
      style: {
        width
      }
    }, content);
  };
  const classes = (0, _classnames.default)(className, {
    'is-default-size': !width
  });
  const blockProps = (0, _blockEditor.useBlockProps)({
    ref,
    className: classes
  });
  const label = (0, _i18n.__)('Add a site logo');
  const mediaInspectorPanel = (canUserEdit || logoUrl) && (0, _react.createElement)(_blockEditor.InspectorControls, null, (0, _react.createElement)(_components.PanelBody, {
    title: (0, _i18n.__)('Media')
  }, (0, _react.createElement)("div", {
    className: "block-library-site-logo__inspector-media-replace-container"
  }, !canUserEdit && !!logoUrl && (0, _react.createElement)(InspectorLogoPreview, {
    mediaItemData: mediaItemData,
    itemGroupProps: {
      isBordered: true,
      className: 'block-library-site-logo__inspector-readonly-logo-preview'
    }
  }), canUserEdit && !!logoUrl && (0, _react.createElement)(SiteLogoReplaceFlow, {
    ...mediaReplaceFlowProps,
    name: (0, _react.createElement)(InspectorLogoPreview, {
      mediaItemData: mediaItemData
    }),
    popoverProps: {}
  }), canUserEdit && !logoUrl && (0, _react.createElement)(_blockEditor.MediaUploadCheck, null, (0, _react.createElement)(_blockEditor.MediaUpload, {
    onSelect: onInitialSelectLogo,
    allowedTypes: ALLOWED_MEDIA_TYPES,
    render: ({
      open
    }) => (0, _react.createElement)("div", {
      className: "block-library-site-logo__inspector-upload-container"
    }, (0, _react.createElement)(_components.Button, {
      onClick: open,
      variant: "secondary"
    }, isLoading ? (0, _react.createElement)(_components.Spinner, null) : (0, _i18n.__)('Add media')), (0, _react.createElement)(_components.DropZone, {
      onFilesDrop: onFilesDrop
    }))
  })))));
  return (0, _react.createElement)("div", {
    ...blockProps
  }, controls, mediaInspectorPanel, !!logoUrl && logoImage, !logoUrl && !canUserEdit && (0, _react.createElement)(_components.Placeholder, {
    className: "site-logo_placeholder"
  }, !!isLoading && (0, _react.createElement)("span", {
    className: "components-placeholder__preview"
  }, (0, _react.createElement)(_components.Spinner, null))), !logoUrl && canUserEdit && (0, _react.createElement)(_blockEditor.MediaPlaceholder, {
    onSelect: onInitialSelectLogo,
    accept: ACCEPT_MEDIA_STRING,
    allowedTypes: ALLOWED_MEDIA_TYPES,
    onError: onUploadError,
    placeholder: placeholder,
    mediaLibraryButton: ({
      open
    }) => {
      return (0, _react.createElement)(_components.Button, {
        icon: _icons.upload,
        variant: "primary",
        label: label,
        showTooltip: true,
        tooltipPosition: "top center",
        onClick: () => {
          open();
        }
      });
    }
  }));
}
//# sourceMappingURL=edit.js.map