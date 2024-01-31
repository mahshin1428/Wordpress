/**
 * Internal dependencies
 */
import initBlock from '../utils/init-block';
const metadata = {
  $schema: "https://schemas.wp.org/trunk/block.json",
  apiVersion: 3,
  name: "core/site-tagline",
  title: "Site Tagline",
  category: "theme",
  description: "Describe in a few words what the site is about. The tagline can be used in search results or when sharing on social networks even if it\u2019s not displayed in the theme design.",
  keywords: ["description"],
  textdomain: "default",
  attributes: {
    textAlign: {
      type: "string"
    }
  },
  example: {},
  supports: {
    align: ["wide", "full"],
    html: false,
    color: {
      gradients: true,
      __experimentalDefaultControls: {
        background: true,
        text: true
      }
    },
    spacing: {
      margin: true,
      padding: true,
      __experimentalDefaultControls: {
        margin: false,
        padding: false
      }
    },
    typography: {
      fontSize: true,
      lineHeight: true,
      __experimentalFontFamily: true,
      __experimentalTextTransform: true,
      __experimentalTextDecoration: true,
      __experimentalFontStyle: true,
      __experimentalFontWeight: true,
      __experimentalLetterSpacing: true,
      __experimentalDefaultControls: {
        fontSize: true
      }
    }
  },
  editorStyle: "wp-block-site-tagline-editor"
};
import edit from './edit';
import icon from './icon';
import deprecated from './deprecated';
const {
  name
} = metadata;
export { metadata, name };
export const settings = {
  icon,
  edit,
  deprecated
};
export const init = () => initBlock({
  name,
  metadata,
  settings
});
//# sourceMappingURL=index.js.map