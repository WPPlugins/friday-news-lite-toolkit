(function() {
  return tinymce.PluginManager.add("friday_shortcodes", function(editor) {
    var grid;
    grid = new Array(12);
    grid[0] = "[friday_col size=12]TEXT[/friday_col]<br/>";
    grid[1] = "[friday_col size=6]TEXT[/friday_col]<br/>";
    grid[1] += "[friday_col size=6]TEXT[/friday_col]<br/>";
    grid[2] = "[friday_col size=4]TEXT[/friday_col]<br/>";
    grid[2] += "[friday_col size=4]TEXT[/friday_col]<br/>";
    grid[2] += "[friday_col size=4]TEXT[/friday_col]<br/>";
    grid[3] = "[friday_col size=4]TEXT[/friday_col]<br/>";
    grid[3] += "[friday_col size=8]TEXT[/friday_col]<br/>";
    grid[4] = "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[4] += "[friday_col size=6]TEXT[/friday_col]<br/>";
    grid[4] += "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[5] = "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[5] += "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[5] += "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[5] += "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[6] = "[friday_col size=3]TEXT[/friday_col]<br/>";
    grid[6] += "[friday_col size=9]TEXT[/friday_col]<br/>";
    grid[7] = "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[7] += "[friday_col size=8]TEXT[/friday_col]<br/>";
    grid[7] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[8] = "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[8] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[8] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[8] += "[friday_col size=6]TEXT[/friday_col]<br/>";
    grid[9] = "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[9] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[9] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[9] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[9] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[9] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[10] = "[friday_col size=8]TEXT[/friday_col]<br/>";
    grid[10] += "[friday_col size=4]TEXT[/friday_col]<br/>";
    grid[11] = "[friday_col size=10]TEXT[/friday_col]<br/>";
    grid[11] += "[friday_col size=2]TEXT[/friday_col]<br/>";
    grid[12] = "[friday_col size=5]TEXT[/friday_col]<br/>";
    grid[12] += "[friday_col size=7]TEXT[/friday_col]<br/>";
    return editor.addButton("friday_shortcodes", {
      type: "splitbutton",
      title: friday_toolkit.i18n.shortcodes,
      icon: "friday_shortcodes",
      menu: [
        {
          text: friday_toolkit.i18n.grid,
          menu: [
            {
              text: "1/1",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[0] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/2 - 1/2",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[1] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/3 - 1/3 - 1/3",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[2] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/3 - 2/3",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[3] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 1/2 - 1/4",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[4] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 1/4 - 1/4 - 1/4",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[5] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 3/4",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[6] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 4/6 - 1/6",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[7] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 1/6 - 1/6 - 1/2",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[8] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[9] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "2/3 - 1/3",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[10] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "5/6 - 1/6",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[11] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            },{
              text: "5/12 - 7/12",
              onclick: function() {
                var shortcode;
                shortcode = "[friday_row]<br/>" + grid[12] + "[/friday_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }
          ]
        },{
          text: friday_toolkit.i18n.container,
          menu: [
            {
              text: friday_toolkit.i18n.tabs,
              onclick: function() {
                var shortcode;
                shortcode = "[friday_tabs]<br/>";
                shortcode += "[friday_tab title=\"Tab title 1\"]Tab content 1[/friday_tab]<br/>";
                shortcode += "[friday_tab title=\"Tab title 2\"]Tab content 2[/friday_tab]<br/>";
                shortcode += "[friday_tab title=\"Tab title 3\"]Tab content 3[/friday_tab]<br/>";
                shortcode += "[/friday_tabs]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: friday_toolkit.i18n.tabs_background,
              onclick: function() {
                var shortcode;
                shortcode = "[friday_tabs type=\"background\"]<br/>";
                shortcode += "[friday_tab title=\"Tab title 1\"]Tab content 1[/friday_tab]<br/>";
                shortcode += "[friday_tab title=\"Tab title 2\"]Tab content 2[/friday_tab]<br/>";
                shortcode += "[friday_tab title=\"Tab title 3\"]Tab content 3[/friday_tab]<br/>";
                shortcode += "[/friday_tabs]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: friday_toolkit.i18n.accordion,
              onclick: function() {
                var shortcode;
                shortcode = "[friday_accordions]<br/>";
                shortcode += "[friday_accordion title=\"Accordion title 1\"]Accordion content 1[/friday_accordion]<br/>";
                shortcode += "[friday_accordion title=\"Accordion title 2\"]Accordion content 2[/friday_accordion]<br/>";
                shortcode += "[friday_accordion title=\"Accordion title 3\"]Accordion content 3[/friday_accordion]<br/>";
                shortcode += "[/friday_accordions]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: friday_toolkit.i18n.toggle,
              onclick: function() {
                var shortcode;
                shortcode = "[friday_toggles]<br/>";
                shortcode += "[friday_toggle title=\"Toggle title 1\"]Toggle content 1[/friday_toggle]<br/>";
                shortcode += "[friday_toggle title=\"Toggle title 2\"]Toggle content 2[/friday_toggle]<br/>";
                shortcode += "[friday_toggle title=\"Toggle title 3\"]Toggle content 3[/friday_toggle]<br/>";
                shortcode += "[/friday_toggles]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }
          ]
        }, {
          text: friday_toolkit.i18n.dropcap,
          icon: "dropcap",
          menu: [
            {
              text: friday_toolkit.i18n.transparent,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_dropcap class=\"kopa-dropcap style-1\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_dropcap]");
              }
            }, {
              text: friday_toolkit.i18n.border,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_dropcap class=\"kopa-dropcap style-2\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_dropcap]");
              }
            }, {
              text: friday_toolkit.i18n.background,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_dropcap class=\"kopa-dropcap style-3\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_dropcap]");
              }
            }
          ]
        }, {
          text: friday_toolkit.i18n.alert,
          menu: [
            {
              text: friday_toolkit.i18n.info,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_alert class=\"alert alert-info alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_alert]");
              }
            }, {
              text: friday_toolkit.i18n.success,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_alert class=\"alert alert-success alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_alert]");
              }
            }, {
              text: friday_toolkit.i18n.warning,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_alert class=\"alert alert-warning alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_alert]");
              }
            }, {
              text: friday_toolkit.i18n.danger,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_alert class=\"alert alert-danger alert-dismissible fade in\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_alert]");
              }
            }
          ]
        }, {
          text: friday_toolkit.i18n.blockquote,
          menu: [
            {
              text: friday_toolkit.i18n.border,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_blockquote class=\"st-1\" title=\"The author name\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_blockquote]");
              }
            }, {
              text: friday_toolkit.i18n.border_left_top,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_blockquote class=\"st-2\" title=\"The author name\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_blockquote]");
              }
            }
          ]
        }, {
          text: friday_toolkit.i18n.button,
          menu: [
            {
              text: friday_toolkit.i18n.large,
              menu: [
                {
                  text: friday_toolkit.i18n.large_yellow,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-yellow btn-lg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.large_black,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-black btn-lg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.large_gray,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-gray btn-lg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.large_pink,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-pink btn-lg\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }
              ]
            }, {
              text: friday_toolkit.i18n.medium,
              menu: [
                {
                  text: friday_toolkit.i18n.medium_yellow,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-yellow\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.medium_black,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-black\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.medium_gray,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-gray\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.medium_pink,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-pink\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }
              ]
            }, {
              text: friday_toolkit.i18n.small,
              menu: [
                {
                  text: friday_toolkit.i18n.small_yellow,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-yellow btn-sm\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.small_black,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-black btn-sm\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.small_gray,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-gray btn-sm\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }, {
                  text: friday_toolkit.i18n.small_pink,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[friday_button class=\"btn btn-pink btn-sm\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/friday_button]");
                  }
                }
              ]
            }
          ]
        }
      ]
    });
  });
})();
