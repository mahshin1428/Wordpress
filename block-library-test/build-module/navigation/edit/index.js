import { createElement, Fragment } from "react";
/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { useCallback, useState, useEffect, useRef, Platform } from '@wordpress/element';
import { InspectorControls, useBlockProps, RecursionProvider, useHasRecursion, store as blockEditorStore, withColors, ContrastChecker, getColorClassName, Warning, __experimentalColorGradientSettingsDropdown as ColorGradientSettingsDropdown, __experimentalUseMultipleOriginColorsAndGradients as useMultipleOriginColorsAndGradients, useBlockEditingMode } from '@wordpress/block-editor';
import { EntityProvider, store as coreStore } from '@wordpress/core-data';
import { useDispatch, useSelect } from '@wordpress/data';
import { PanelBody, ToggleControl, __experimentalToggleGroupControl as ToggleGroupControl, __experimentalToggleGroupControlOption as ToggleGroupControlOption, Button, Spinner, Notice } from '@wordpress/components';
import { __, sprintf } from '@wordpress/i18n';
import { speak } from '@wordpress/a11y';
import { close, Icon } from '@wordpress/icons';
import { useInstanceId, useMediaQuery } from '@wordpress/compose';

/**
 * Internal dependencies
 */
import useNavigationMenu from '../use-navigation-menu';
import useNavigationEntities from '../use-navigation-entities';
import Placeholder from './placeholder';
import ResponsiveWrapper from './responsive-wrapper';
import NavigationInnerBlocks from './inner-blocks';
import NavigationMenuNameControl from './navigation-menu-name-control';
import UnsavedInnerBlocks from './unsaved-inner-blocks';
import NavigationMenuDeleteControl from './navigation-menu-delete-control';
import useNavigationNotice from './use-navigation-notice';
import OverlayMenuIcon from './overlay-menu-icon';
import OverlayMenuPreview from './overlay-menu-preview';
import useConvertClassicToBlockMenu, { CLASSIC_MENU_CONVERSION_ERROR, CLASSIC_MENU_CONVERSION_PENDING, CLASSIC_MENU_CONVERSION_SUCCESS } from './use-convert-classic-menu-to-block-menu';
import useCreateNavigationMenu from './use-create-navigation-menu';
import { useInnerBlocks } from './use-inner-blocks';
import { detectColors } from './utils';
import ManageMenusButton from './manage-menus-button';
import MenuInspectorControls from './menu-inspector-controls';
import DeletedNavigationWarning from './deleted-navigation-warning';
import AccessibleDescription from './accessible-description';
import AccessibleMenuDescription from './accessible-menu-description';
import { NAVIGATION_MOBILE_COLLAPSE } from '../constants';
import { unlock } from '../../lock-unlock';
function Navigation({
  attributes,
  setAttributes,
  clientId,
  isSelected,
  className,
  backgroundColor,
  setBackgroundColor,
  textColor,
  setTextColor,
  overlayBackgroundColor,
  setOverlayBackgroundColor,
  overlayTextColor,
  setOverlayTextColor,
  // These props are used by the navigation editor to override specific
  // navigation block settings.
  hasSubmenuIndicatorSetting = true,
  customPlaceholder: CustomPlaceholder = null,
  __unstableLayoutClassNames: layoutClassNames
}) {
  const {
    openSubmenusOnClick,
    overlayMenu,
    showSubmenuIcon,
    templateLock,
    layout: {
      justifyContent,
      orientation = 'horizontal',
      flexWrap = 'wrap'
    } = {},
    hasIcon,
    icon = 'handle'
  } = attributes;
  const ref = attributes.ref;
  const setRef = useCallback(postId => {
    setAttributes({
      ref: postId
    });
  }, [setAttributes]);
  const recursionId = `navigationMenu/${ref}`;
  const hasAlreadyRendered = useHasRecursion(recursionId);
  const blockEditingMode = useBlockEditingMode();

  // Preload classic menus, so that they don't suddenly pop-in when viewing
  // the Select Menu dropdown.
  const {
    menus: classicMenus
  } = useNavigationEntities();
  const [showNavigationMenuStatusNotice, hideNavigationMenuStatusNotice] = useNavigationNotice({
    name: 'block-library/core/navigation/status'
  });
  const [showClassicMenuConversionNotice, hideClassicMenuConversionNotice] = useNavigationNotice({
    name: 'block-library/core/navigation/classic-menu-conversion'
  });
  const [showNavigationMenuPermissionsNotice, hideNavigationMenuPermissionsNotice] = useNavigationNotice({
    name: 'block-library/core/navigation/permissions/update'
  });
  const {
    create: createNavigationMenu,
    status: createNavigationMenuStatus,
    error: createNavigationMenuError,
    value: createNavigationMenuPost,
    isPending: isCreatingNavigationMenu,
    isSuccess: createNavigationMenuIsSuccess,
    isError: createNavigationMenuIsError
  } = useCreateNavigationMenu(clientId);
  const createUntitledEmptyNavigationMenu = () => {
    createNavigationMenu('');
  };
  const {
    hasUncontrolledInnerBlocks,
    uncontrolledInnerBlocks,
    isInnerBlockSelected,
    innerBlocks
  } = useInnerBlocks(clientId);
  const hasSubmenus = !!innerBlocks.find(block => block.name === 'core/navigation-submenu');
  const {
    replaceInnerBlocks,
    selectBlock,
    __unstableMarkNextChangeAsNotPersistent
  } = useDispatch(blockEditorStore);
  const [isResponsiveMenuOpen, setResponsiveMenuVisibility] = useState(false);
  const [overlayMenuPreview, setOverlayMenuPreview] = useState(false);
  const {
    hasResolvedNavigationMenus,
    isNavigationMenuResolved,
    isNavigationMenuMissing,
    canUserUpdateNavigationMenu,
    hasResolvedCanUserUpdateNavigationMenu,
    canUserDeleteNavigationMenu,
    hasResolvedCanUserDeleteNavigationMenu,
    canUserCreateNavigationMenu,
    isResolvingCanUserCreateNavigationMenu,
    hasResolvedCanUserCreateNavigationMenu
  } = useNavigationMenu(ref);
  const navMenuResolvedButMissing = hasResolvedNavigationMenus && isNavigationMenuMissing;
  const {
    convert: convertClassicMenu,
    status: classicMenuConversionStatus,
    error: classicMenuConversionError
  } = useConvertClassicToBlockMenu(createNavigationMenu);
  const isConvertingClassicMenu = classicMenuConversionStatus === CLASSIC_MENU_CONVERSION_PENDING;
  const handleUpdateMenu = useCallback((menuId, options = {
    focusNavigationBlock: false
  }) => {
    const {
      focusNavigationBlock
    } = options;
    setRef(menuId);
    if (focusNavigationBlock) {
      selectBlock(clientId);
    }
  }, [selectBlock, clientId, setRef]);
  const isEntityAvailable = !isNavigationMenuMissing && isNavigationMenuResolved;

  // If the block has inner blocks, but no menu id, then these blocks are either:
  // - inserted via a pattern.
  // - inserted directly via Code View (or otherwise).
  // - from an older version of navigation block added before the block used a wp_navigation entity.
  // Consider this state as 'unsaved' and offer an uncontrolled version of inner blocks,
  // that automatically saves the menu as an entity when changes are made to the inner blocks.
  const hasUnsavedBlocks = hasUncontrolledInnerBlocks && !isEntityAvailable;
  const {
    getNavigationFallbackId
  } = unlock(useSelect(coreStore));
  const navigationFallbackId = !(ref || hasUnsavedBlocks) ? getNavigationFallbackId() : null;
  useEffect(() => {
    // If:
    // - there is an existing menu, OR
    // - there are existing (uncontrolled) inner blocks
    // ...then don't request a fallback menu.
    if (ref || hasUnsavedBlocks || !navigationFallbackId) {
      return;
    }

    /**
     *  This fallback displays (both in editor and on front)
     *  The fallback should not request a save (entity dirty state)
     *  nor to be undoable, hence why it is marked as non persistent
     */

    __unstableMarkNextChangeAsNotPersistent();
    setRef(navigationFallbackId);
  }, [ref, setRef, hasUnsavedBlocks, navigationFallbackId, __unstableMarkNextChangeAsNotPersistent]);
  const navRef = useRef();

  // The standard HTML5 tag for the block wrapper.
  const TagName = 'nav';

  // "placeholder" shown if:
  // - there is no ref attribute pointing to a Navigation Post.
  // - there is no classic menu conversion process in progress.
  // - there is no menu creation process in progress.
  // - there are no uncontrolled blocks.
  const isPlaceholder = !ref && !isCreatingNavigationMenu && !isConvertingClassicMenu && hasResolvedNavigationMenus && classicMenus?.length === 0 && !hasUncontrolledInnerBlocks;

  // "loading" state:
  // - there is a menu creation process in progress.
  // - there is a classic menu conversion process in progress.
  // OR:
  // - there is a ref attribute pointing to a Navigation Post
  // - the Navigation Post isn't available (hasn't resolved) yet.
  const isLoading = !hasResolvedNavigationMenus || isCreatingNavigationMenu || isConvertingClassicMenu || !!(ref && !isEntityAvailable && !isConvertingClassicMenu);
  const textDecoration = attributes.style?.typography?.textDecoration;
  const hasBlockOverlay = useSelect(select => select(blockEditorStore).__unstableHasActiveBlockOverlayActive(clientId), [clientId]);
  const isResponsive = 'never' !== overlayMenu;
  const isMobileBreakPoint = useMediaQuery(`(max-width: ${NAVIGATION_MOBILE_COLLAPSE})`);
  const isCollapsed = 'mobile' === overlayMenu && isMobileBreakPoint || 'always' === overlayMenu;
  const blockProps = useBlockProps({
    ref: navRef,
    className: classnames(className, {
      'items-justified-right': justifyContent === 'right',
      'items-justified-space-between': justifyContent === 'space-between',
      'items-justified-left': justifyContent === 'left',
      'items-justified-center': justifyContent === 'center',
      'is-vertical': orientation === 'vertical',
      'no-wrap': flexWrap === 'nowrap',
      'is-responsive': isResponsive,
      'is-collapsed': isCollapsed,
      'has-text-color': !!textColor.color || !!textColor?.class,
      [getColorClassName('color', textColor?.slug)]: !!textColor?.slug,
      'has-background': !!backgroundColor.color || backgroundColor.class,
      [getColorClassName('background-color', backgroundColor?.slug)]: !!backgroundColor?.slug,
      [`has-text-decoration-${textDecoration}`]: textDecoration,
      'block-editor-block-content-overlay': hasBlockOverlay
    }, layoutClassNames),
    style: {
      color: !textColor?.slug && textColor?.color,
      backgroundColor: !backgroundColor?.slug && backgroundColor?.color
    }
  });

  // Turn on contrast checker for web only since it's not supported on mobile yet.
  const enableContrastChecking = Platform.OS === 'web';
  const [detectedBackgroundColor, setDetectedBackgroundColor] = useState();
  const [detectedColor, setDetectedColor] = useState();
  const [detectedOverlayBackgroundColor, setDetectedOverlayBackgroundColor] = useState();
  const [detectedOverlayColor, setDetectedOverlayColor] = useState();
  const onSelectClassicMenu = async classicMenu => {
    const navMenu = await convertClassicMenu(classicMenu.id, classicMenu.name, 'draft');
    if (navMenu) {
      handleUpdateMenu(navMenu.id, {
        focusNavigationBlock: true
      });
    }
  };
  const onSelectNavigationMenu = menuId => {
    handleUpdateMenu(menuId);
  };
  useEffect(() => {
    hideNavigationMenuStatusNotice();
    if (isCreatingNavigationMenu) {
      speak(__(`Creating Navigation Menu.`));
    }
    if (createNavigationMenuIsSuccess) {
      handleUpdateMenu(createNavigationMenuPost?.id, {
        focusNavigationBlock: true
      });
      showNavigationMenuStatusNotice(__(`Navigation Menu successfully created.`));
    }
    if (createNavigationMenuIsError) {
      showNavigationMenuStatusNotice(__('Failed to create Navigation Menu.'));
    }
  }, [createNavigationMenuStatus, createNavigationMenuError, createNavigationMenuPost?.id, createNavigationMenuIsError, createNavigationMenuIsSuccess, isCreatingNavigationMenu, handleUpdateMenu, hideNavigationMenuStatusNotice, showNavigationMenuStatusNotice]);
  useEffect(() => {
    hideClassicMenuConversionNotice();
    if (classicMenuConversionStatus === CLASSIC_MENU_CONVERSION_PENDING) {
      speak(__('Classic menu importing.'));
    }
    if (classicMenuConversionStatus === CLASSIC_MENU_CONVERSION_SUCCESS) {
      showClassicMenuConversionNotice(__('Classic menu imported successfully.'));
    }
    if (classicMenuConversionStatus === CLASSIC_MENU_CONVERSION_ERROR) {
      showClassicMenuConversionNotice(__('Classic menu import failed.'));
    }
  }, [classicMenuConversionStatus, classicMenuConversionError, hideClassicMenuConversionNotice, showClassicMenuConversionNotice]);
  useEffect(() => {
    if (!enableContrastChecking) {
      return;
    }
    detectColors(navRef.current, setDetectedColor, setDetectedBackgroundColor);
    const subMenuElement = navRef.current?.querySelector('[data-type="core/navigation-submenu"] [data-type="core/navigation-link"]');
    if (!subMenuElement) {
      return;
    }

    // Only detect submenu overlay colors if they have previously been explicitly set.
    // This avoids the contrast checker from reporting on inherited submenu colors and
    // showing the contrast warning twice.
    if (overlayTextColor.color || overlayBackgroundColor.color) {
      detectColors(subMenuElement, setDetectedOverlayColor, setDetectedOverlayBackgroundColor);
    }
  }, [enableContrastChecking, overlayTextColor.color, overlayBackgroundColor.color]);
  useEffect(() => {
    if (!isSelected && !isInnerBlockSelected) {
      hideNavigationMenuPermissionsNotice();
    }
    if (isSelected || isInnerBlockSelected) {
      if (ref && !navMenuResolvedButMissing && hasResolvedCanUserUpdateNavigationMenu && !canUserUpdateNavigationMenu) {
        showNavigationMenuPermissionsNotice(__('You do not have permission to edit this Menu. Any changes made will not be saved.'));
      }
      if (!ref && hasResolvedCanUserCreateNavigationMenu && !canUserCreateNavigationMenu) {
        showNavigationMenuPermissionsNotice(__('You do not have permission to create Navigation Menus.'));
      }
    }
  }, [isSelected, isInnerBlockSelected, canUserUpdateNavigationMenu, hasResolvedCanUserUpdateNavigationMenu, canUserCreateNavigationMenu, hasResolvedCanUserCreateNavigationMenu, ref, hideNavigationMenuPermissionsNotice, showNavigationMenuPermissionsNotice, navMenuResolvedButMissing]);
  const hasManagePermissions = canUserCreateNavigationMenu || canUserUpdateNavigationMenu;
  const overlayMenuPreviewClasses = classnames('wp-block-navigation__overlay-menu-preview', {
    open: overlayMenuPreview
  });
  const submenuAccessibilityNotice = !showSubmenuIcon && !openSubmenusOnClick ? __('The current menu options offer reduced accessibility for users and are not recommended. Enabling either "Open on Click" or "Show arrow" offers enhanced accessibility by allowing keyboard users to browse submenus selectively.') : '';
  const isFirstRender = useRef(true); // Don't speak on first render.
  useEffect(() => {
    if (!isFirstRender.current && submenuAccessibilityNotice) {
      speak(submenuAccessibilityNotice);
    }
    isFirstRender.current = false;
  }, [submenuAccessibilityNotice]);
  const overlayMenuPreviewId = useInstanceId(OverlayMenuPreview, `overlay-menu-preview`);
  const colorGradientSettings = useMultipleOriginColorsAndGradients();
  const stylingInspectorControls = createElement(Fragment, null, createElement(InspectorControls, null, hasSubmenuIndicatorSetting && createElement(PanelBody, {
    title: __('Display')
  }, isResponsive && createElement(Fragment, null, createElement(Button, {
    className: overlayMenuPreviewClasses,
    onClick: () => {
      setOverlayMenuPreview(!overlayMenuPreview);
    },
    "aria-label": __('Overlay menu controls'),
    "aria-controls": overlayMenuPreviewId,
    "aria-expanded": overlayMenuPreview
  }, hasIcon && createElement(Fragment, null, createElement(OverlayMenuIcon, {
    icon: icon
  }), createElement(Icon, {
    icon: close
  })), !hasIcon && createElement(Fragment, null, createElement("span", null, __('Menu')), createElement("span", null, __('Close')))), createElement("div", {
    id: overlayMenuPreviewId
  }, overlayMenuPreview && createElement(OverlayMenuPreview, {
    setAttributes: setAttributes,
    hasIcon: hasIcon,
    icon: icon,
    hidden: !overlayMenuPreview
  }))), createElement("h3", null, __('Overlay Menu')), createElement(ToggleGroupControl, {
    __nextHasNoMarginBottom: true,
    label: __('Configure overlay menu'),
    value: overlayMenu,
    help: __('Collapses the navigation options in a menu icon opening an overlay.'),
    onChange: value => setAttributes({
      overlayMenu: value
    }),
    isBlock: true,
    hideLabelFromVision: true
  }, createElement(ToggleGroupControlOption, {
    value: "never",
    label: __('Off')
  }), createElement(ToggleGroupControlOption, {
    value: "mobile",
    label: __('Mobile')
  }), createElement(ToggleGroupControlOption, {
    value: "always",
    label: __('Always')
  })), hasSubmenus && createElement(Fragment, null, createElement("h3", null, __('Submenus')), createElement(ToggleControl, {
    __nextHasNoMarginBottom: true,
    checked: openSubmenusOnClick,
    onChange: value => {
      setAttributes({
        openSubmenusOnClick: value,
        ...(value && {
          showSubmenuIcon: true
        }) // Make sure arrows are shown when we toggle this on.
      });
    },
    label: __('Open on click')
  }), createElement(ToggleControl, {
    __nextHasNoMarginBottom: true,
    checked: showSubmenuIcon,
    onChange: value => {
      setAttributes({
        showSubmenuIcon: value
      });
    },
    disabled: attributes.openSubmenusOnClick,
    label: __('Show arrow')
  }), submenuAccessibilityNotice && createElement("div", null, createElement(Notice, {
    spokenMessage: null,
    status: "warning",
    isDismissible: false
  }, submenuAccessibilityNotice))))), colorGradientSettings.hasColorsOrGradients && createElement(InspectorControls, {
    group: "color"
  }, createElement(ColorGradientSettingsDropdown, {
    __experimentalIsRenderedInSidebar: true,
    settings: [{
      colorValue: textColor.color,
      label: __('Text'),
      onColorChange: setTextColor,
      resetAllFilter: () => setTextColor()
    }, {
      colorValue: backgroundColor.color,
      label: __('Background'),
      onColorChange: setBackgroundColor,
      resetAllFilter: () => setBackgroundColor()
    }, {
      colorValue: overlayTextColor.color,
      label: __('Submenu & overlay text'),
      onColorChange: setOverlayTextColor,
      resetAllFilter: () => setOverlayTextColor()
    }, {
      colorValue: overlayBackgroundColor.color,
      label: __('Submenu & overlay background'),
      onColorChange: setOverlayBackgroundColor,
      resetAllFilter: () => setOverlayBackgroundColor()
    }],
    panelId: clientId,
    ...colorGradientSettings,
    gradients: [],
    disableCustomGradients: true
  }), enableContrastChecking && createElement(Fragment, null, createElement(ContrastChecker, {
    backgroundColor: detectedBackgroundColor,
    textColor: detectedColor
  }), createElement(ContrastChecker, {
    backgroundColor: detectedOverlayBackgroundColor,
    textColor: detectedOverlayColor
  }))));
  const accessibleDescriptionId = `${clientId}-desc`;
  const isManageMenusButtonDisabled = !hasManagePermissions || !hasResolvedNavigationMenus;
  if (hasUnsavedBlocks && !isCreatingNavigationMenu) {
    return createElement(TagName, {
      ...blockProps,
      "aria-describedby": !isPlaceholder ? accessibleDescriptionId : undefined
    }, createElement(AccessibleDescription, {
      id: accessibleDescriptionId
    }, __('Unsaved Navigation Menu.')), createElement(MenuInspectorControls, {
      clientId: clientId,
      createNavigationMenuIsSuccess: createNavigationMenuIsSuccess,
      createNavigationMenuIsError: createNavigationMenuIsError,
      currentMenuId: ref,
      isNavigationMenuMissing: isNavigationMenuMissing,
      isManageMenusButtonDisabled: isManageMenusButtonDisabled,
      onCreateNew: createUntitledEmptyNavigationMenu,
      onSelectClassicMenu: onSelectClassicMenu,
      onSelectNavigationMenu: onSelectNavigationMenu,
      isLoading: isLoading,
      blockEditingMode: blockEditingMode
    }), blockEditingMode === 'default' && stylingInspectorControls, createElement(ResponsiveWrapper, {
      id: clientId,
      onToggle: setResponsiveMenuVisibility,
      isOpen: isResponsiveMenuOpen,
      hasIcon: hasIcon,
      icon: icon,
      isResponsive: isResponsive,
      isHiddenByDefault: 'always' === overlayMenu,
      overlayBackgroundColor: overlayBackgroundColor,
      overlayTextColor: overlayTextColor
    }, createElement(UnsavedInnerBlocks, {
      createNavigationMenu: createNavigationMenu,
      blocks: uncontrolledInnerBlocks,
      hasSelection: isSelected || isInnerBlockSelected
    })));
  }

  // Show a warning if the selected menu is no longer available.
  // TODO - the user should be able to select a new one?
  if (ref && isNavigationMenuMissing) {
    return createElement(TagName, {
      ...blockProps
    }, createElement(MenuInspectorControls, {
      clientId: clientId,
      createNavigationMenuIsSuccess: createNavigationMenuIsSuccess,
      createNavigationMenuIsError: createNavigationMenuIsError,
      currentMenuId: ref,
      isNavigationMenuMissing: isNavigationMenuMissing,
      isManageMenusButtonDisabled: isManageMenusButtonDisabled,
      onCreateNew: createUntitledEmptyNavigationMenu,
      onSelectClassicMenu: onSelectClassicMenu,
      onSelectNavigationMenu: onSelectNavigationMenu,
      isLoading: isLoading,
      blockEditingMode: blockEditingMode
    }), createElement(DeletedNavigationWarning, {
      onCreateNew: createUntitledEmptyNavigationMenu
    }));
  }
  if (isEntityAvailable && hasAlreadyRendered) {
    return createElement("div", {
      ...blockProps
    }, createElement(Warning, null, __('Block cannot be rendered inside itself.')));
  }
  const PlaceholderComponent = CustomPlaceholder ? CustomPlaceholder : Placeholder;

  /**
   * Historically the navigation block has supported custom placeholders.
   * Even though the current UX tries as hard as possible not to
   * end up in a placeholder state, the block continues to support
   * this extensibility point, via a CustomPlaceholder.
   * When CustomPlaceholder is present it becomes the default fallback
   * for an empty navigation block, instead of the default fallbacks.
   *
   */

  if (isPlaceholder && CustomPlaceholder) {
    return createElement(TagName, {
      ...blockProps
    }, createElement(PlaceholderComponent, {
      isSelected: isSelected,
      currentMenuId: ref,
      clientId: clientId,
      canUserCreateNavigationMenu: canUserCreateNavigationMenu,
      isResolvingCanUserCreateNavigationMenu: isResolvingCanUserCreateNavigationMenu,
      onSelectNavigationMenu: onSelectNavigationMenu,
      onSelectClassicMenu: onSelectClassicMenu,
      onCreateEmpty: createUntitledEmptyNavigationMenu
    }));
  }
  return createElement(EntityProvider, {
    kind: "postType",
    type: "wp_navigation",
    id: ref
  }, createElement(RecursionProvider, {
    uniqueId: recursionId
  }, createElement(MenuInspectorControls, {
    clientId: clientId,
    createNavigationMenuIsSuccess: createNavigationMenuIsSuccess,
    createNavigationMenuIsError: createNavigationMenuIsError,
    currentMenuId: ref,
    isNavigationMenuMissing: isNavigationMenuMissing,
    isManageMenusButtonDisabled: isManageMenusButtonDisabled,
    onCreateNew: createUntitledEmptyNavigationMenu,
    onSelectClassicMenu: onSelectClassicMenu,
    onSelectNavigationMenu: onSelectNavigationMenu,
    isLoading: isLoading,
    blockEditingMode: blockEditingMode
  }), blockEditingMode === 'default' && stylingInspectorControls, blockEditingMode === 'default' && isEntityAvailable && createElement(InspectorControls, {
    group: "advanced"
  }, hasResolvedCanUserUpdateNavigationMenu && canUserUpdateNavigationMenu && createElement(NavigationMenuNameControl, null), hasResolvedCanUserDeleteNavigationMenu && canUserDeleteNavigationMenu && createElement(NavigationMenuDeleteControl, {
    onDelete: (deletedMenuTitle = '') => {
      replaceInnerBlocks(clientId, []);
      showNavigationMenuStatusNotice(sprintf(
      // translators: %s: the name of a menu (e.g. Header navigation).
      __('Navigation menu %s successfully deleted.'), deletedMenuTitle));
    }
  }), createElement(ManageMenusButton, {
    disabled: isManageMenusButtonDisabled,
    className: "wp-block-navigation-manage-menus-button"
  })), isLoading && createElement(TagName, {
    ...blockProps
  }, createElement("div", {
    className: "wp-block-navigation__loading-indicator-container"
  }, createElement(Spinner, {
    className: "wp-block-navigation__loading-indicator"
  }))), !isLoading && createElement(TagName, {
    ...blockProps,
    "aria-describedby": !isPlaceholder ? accessibleDescriptionId : undefined
  }, createElement(AccessibleMenuDescription, {
    id: accessibleDescriptionId
  }), createElement(ResponsiveWrapper, {
    id: clientId,
    onToggle: setResponsiveMenuVisibility,
    hasIcon: hasIcon,
    icon: icon,
    isOpen: isResponsiveMenuOpen,
    isResponsive: isResponsive,
    isHiddenByDefault: 'always' === overlayMenu,
    overlayBackgroundColor: overlayBackgroundColor,
    overlayTextColor: overlayTextColor
  }, isEntityAvailable && createElement(NavigationInnerBlocks, {
    clientId: clientId,
    hasCustomPlaceholder: !!CustomPlaceholder,
    templateLock: templateLock,
    orientation: orientation
  })))));
}
export default withColors({
  textColor: 'color'
}, {
  backgroundColor: 'color'
}, {
  overlayBackgroundColor: 'color'
}, {
  overlayTextColor: 'color'
})(Navigation);
//# sourceMappingURL=index.js.map