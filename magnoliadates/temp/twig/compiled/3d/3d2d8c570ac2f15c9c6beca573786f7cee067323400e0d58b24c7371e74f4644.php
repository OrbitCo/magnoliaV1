<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* user_media_list.twig */
class __TwigTemplate_11d280be115fe1a93f4414cb433bbe67d8d0f4fbbadb46d56988ad79c615d5b4 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $this->loadTemplate("@app/header.twig", "user_media_list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
      <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
          <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
            <li>
              <a href=\"";
        // line 8
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/";
        echo ($context["user_id"] ?? null);
        echo "\">
                ";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("table_header_personal"        ,"users"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 10
        echo "              </a>
            </li>

        ";
        // line 13
        if (($context["sections"] ?? null)) {
            // line 14
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 15
                echo "                <li>
                    <a href=\"";
                // line 16
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "/";
                echo ($context["user_id"] ?? null);
                echo "\">
                      ";
                // line 17
                echo $this->getAttribute($context["item"], "name", []);
                echo "</a>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "        ";
        }
        // line 21
        echo "        ";
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("seo_advanced"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        $context['is_module_installed'] = $result;
        // line 22
        echo "        ";
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "seo_advanced", [])) {
            // line 23
            echo "            <li>
                <a href=\"";
            // line 24
            echo ($context["site_url"] ?? null);
            echo "admin/users/edit/seo/";
            echo ($context["user_id"] ?? null);
            echo "\">
                    ";
            // line 25
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("filter_section_seo"            ,"seo"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 26
            echo "                </a>
            </li>
        ";
        }
        // line 29
        echo "            <li class=\"active\">
                <a href=\"";
        // line 30
        echo ($context["site_url"] ?? null);
        echo "admin/media/user_media/";
        echo ($context["user_id"] ?? null);
        echo "/";
        echo ($context["param"] ?? null);
        echo "\">
                    ";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_section_uploads"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 32
        echo "                </a>
            </li>
        </ul>
      </div>

    <div class=\"x_content\">
      <div id=\"actions\" class=\"hide\">
            <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
              <label class=\"btn btn-default ";
        // line 40
        if ((($context["param"] ?? null) == "photo")) {
            echo "active";
        }
        echo "\"
                     data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                     onclick=\"document.location.href='";
        // line 42
        echo ($context["site_url"] ?? null);
        echo "admin/media/user_media/";
        echo ($context["user_id"] ?? null);
        echo "/photo'\">
                <input type=\"radio\"> ";
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_section_photos"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 44
        echo "              </label>
              <label class=\"btn btn-default ";
        // line 45
        if ((($context["param"] ?? null) == "video")) {
            echo "active";
        }
        echo "\"
                    data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                    onclick=\"document.location.href='";
        // line 47
        echo ($context["site_url"] ?? null);
        echo "admin/media/user_media/";
        echo ($context["user_id"] ?? null);
        echo "/video'\">
                <input type=\"radio\">
                ";
        // line 49
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_section_videos"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 50
        echo "              </label>
              <label class=\"btn btn-default ";
        // line 51
        if ((($context["param"] ?? null) == "audio")) {
            echo "active";
        }
        echo "\"
                    data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                    onclick=\"document.location.href='";
        // line 53
        echo ($context["site_url"] ?? null);
        echo "admin/media/user_media/";
        echo ($context["user_id"] ?? null);
        echo "/audio'\">
                <input type=\"radio\">
                ";
        // line 55
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("audio"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 56
        echo "              </label>
            </div>
      </div>

      <table id=\"data\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
        <thead>
          <tr class=\"headings\">
              <th class=\"column-title\">";
        // line 63
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_files"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</th>
              <th class=\"column-title\">";
        // line 64
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("media_info"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</th>
              <th class=\"column-title text-center\">18+</th>
              <th class=\"column-title\"></th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 70
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["media"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 71
            echo "              <tr class=\"even pointer ";
            if (($this->getAttribute($context["item"], "is_adult", []) != 0)) {
                echo "adult";
            }
            echo "\">
                  <td>
                      ";
            // line 73
            if ($this->getAttribute($context["item"], "media", [])) {
                // line 74
                echo "                          <a href=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "file_url", []);
                echo "\" target=\"_blank\">
                              <img src=\"";
                // line 75
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "thumbs", []), "small", []);
                echo "\"/>
                          </a>
                      ";
            }
            // line 78
            echo "                      ";
            if ($this->getAttribute($context["item"], "video_content", [])) {
                // line 79
                echo "                          <span onclick=\"vpreview = new loadingContent({'closeBtnClass': 'w'});
                                  vpreview.show_load_block('";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["item"], "video_content", []), "embed", []));
                echo "');\">
                              <img class=\"pointer\" src=\"";
                // line 81
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "video_content", []), "thumbs", []), "small", []);
                echo "\" />
                          </span>
                      ";
            }
            // line 84
            echo "                  </td>
                  <td>
                      <b>";
            // line 86
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("media_owner"            ,"media"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</b>: ";
            echo $this->getAttribute($this->getAttribute($context["item"], "owner_info", []), "output_name", []);
            echo "<br>
                      <b>";
            // line 87
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("media_user"            ,"media"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</b>: ";
            echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "output_name", []);
            echo "<br>
                      <b>";
            // line 88
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_permitted_for"            ,"media"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</b>:
                        ";
            // line 89
            $module =             null;
            $helper =             'lang';
            $name =             'ld_option';
            $params = array("permissions"            ,"media"            ,$this->getAttribute(($context["item"] ?? null), "permissions", [])            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 90
            echo "                  </td>
                  <td class=\"text-center\">
                    ";
            // line 92
            if (($this->getAttribute($context["item"], "is_adult", []) == 0)) {
                // line 93
                echo "                        <span class=\"label label-default\">18+</span>
                    ";
            } else {
                // line 95
                echo "                        <span class=\"label label-danger\">18+</span>
                    ";
            }
            // line 97
            echo "                  </td>
                  <td class=\"icons\" ";
            // line 98
            if ((($context["param"] ?? null) == "photo")) {
                echo " id=\"media_";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" ";
            }
            echo ">
                    <div class=\"btn-group\">
                      <a href=\"";
            // line 100
            echo ($context["site_url"] ?? null);
            echo "admin/media/delete_media/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" class=\"btn btn-primary\">
                        ";
            // line 101
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_delete"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 102
            echo "                      </a>
                      <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                              aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                      </button>
                      <ul class=\"dropdown-menu\">
                        <li>
                          <a href=\"";
            // line 110
            echo ($context["site_url"] ?? null);
            echo "admin/media/delete_media/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                            ";
            // line 111
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_delete"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 112
            echo "                          </a>
                        </li>
                        ";
            // line 114
            if ((($context["param"] ?? null) == "photo")) {
                // line 115
                echo "                            <li class=\"moderation-action-js-edit\" onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("moderation"                ,"btn_edit"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "\">
                                <a data-click=\"view-media\"   ";
                // line 116
                if (($this->getAttribute($context["item"], "type_name", []) == "user_logo")) {
                    echo "  id=\"logo_";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"  ";
                }
                echo "  data-id-media=\"";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" data-user-id=\"";
                echo $this->getAttribute($context["item"], "id_owner", []);
                echo "\">
                                    ";
                // line 117
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("edit_object"                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 118
                echo "                                </a>

                            </li>
                        ";
            }
            // line 122
            echo "                      </ul>
                      ";
            // line 123
            if ((($context["param"] ?? null) == "photo")) {
                // line 124
                echo "                        <script>
                              \$(function () {
                                  loadScripts(
                                          \"";
                // line 127
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array("media"                ,"../views/flatty/js/media.js"                ,"path"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "\",
                                          function () {
                                              recent_mediagallery = new media({
                                                  siteUrl: site_url,
                                                  gallery_name: 'recent_mediagallery',
                                                  galleryContentPage: 1,
                                                  idUser: '";
                // line 133
                echo $this->getAttribute($context["item"], "id_owner", []);
                echo "',
                                                  all_loaded: 1,
                                                  post_data: {filter_duplicate: 1},
                                                  load_on_scroll: false,
                                                  viewMediaUrl: 'admin/media/ajax_view_media',
                                                  galleryContentDiv: 'media_";
                // line 138
                echo $this->getAttribute($context["item"], "id", []);
                echo "',
                                                  direction: 'desc'
                                              });
                                          },
                                          'recent_mediagallery',
                                          {async: false}
                                  );
                              });
                      </script>
                    ";
            }
            // line 148
            echo "                    </div>
                  </td>
              </tr>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 152
        echo "      </table>

      ";
        // line 154
        $this->loadTemplate("@app/pagination.twig", "user_media_list.twig", 154)->display($context);
        // line 155
        echo "    </div>
  </div>
</div>
<div class=\"clearfix\"></div>

<!-- Datatables -->
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        loadScripts(\"";
        // line 164
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery.imgareaselect/jquery.imgareaselect.js"        ,"path"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\", function () {}, '', {async: false});
        var oTable = \$('#data').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 167
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_all_column"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo ":\",
                \"sEmptyTable\": \"";
        // line 168
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_media"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\"
            },
            \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': []
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
            \"bSort\": false,
            \"dom\": 'T<\"clear\"><\"actions\">lfrtip',
        });
        \$(\"tfoot input\").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, \$(\"tfoot th\").index(\$(this).parent()));
        });
        \$(\"tfoot input\").each(function (i) {
            asInitVals[i] = this.value;
        });
        \$(\"tfoot input\").focus(function () {
            if (this.className == \"search_init\") {
                this.className = \"\";
                this.value = \"\";
            }
        });
        \$(\"tfoot input\").blur(function (i) {
            if (this.value == \"\") {
                this.className = \"search_init\";
                this.value = asInitVals[\$(\"tfoot input\").index(this)];
            }
        });
        var actions = \$(\"#actions\");
        \$('#data_wrapper').find('.actions').html(actions.html());
        actions.remove();
    });
</script>

";
        // line 207
        $this->loadTemplate("@app/footer.twig", "user_media_list.twig", 207)->display($context);
    }

    public function getTemplateName()
    {
        return "user_media_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  866 => 207,  805 => 168,  782 => 167,  757 => 164,  746 => 155,  744 => 154,  740 => 152,  731 => 148,  718 => 138,  710 => 133,  682 => 127,  677 => 124,  675 => 123,  672 => 122,  666 => 118,  645 => 117,  633 => 116,  609 => 115,  607 => 114,  603 => 112,  582 => 111,  576 => 110,  566 => 102,  545 => 101,  539 => 100,  530 => 98,  527 => 97,  523 => 95,  519 => 93,  517 => 92,  513 => 90,  492 => 89,  469 => 88,  444 => 87,  419 => 86,  415 => 84,  409 => 81,  405 => 80,  402 => 79,  399 => 78,  393 => 75,  388 => 74,  386 => 73,  378 => 71,  374 => 70,  346 => 64,  323 => 63,  314 => 56,  293 => 55,  286 => 53,  279 => 51,  276 => 50,  255 => 49,  248 => 47,  241 => 45,  238 => 44,  217 => 43,  211 => 42,  204 => 40,  194 => 32,  173 => 31,  165 => 30,  162 => 29,  157 => 26,  136 => 25,  130 => 24,  127 => 23,  124 => 22,  102 => 21,  99 => 20,  90 => 17,  82 => 16,  79 => 15,  74 => 14,  72 => 13,  67 => 10,  46 => 9,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_media_list.twig", "/home/mliadov/public_html/application/modules/media/views/gentelella/user_media_list.twig");
    }
}
