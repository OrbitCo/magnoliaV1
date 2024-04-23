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

/* media_list.twig */
class __TwigTemplate_d318f109450ff65491571525496e715b523f5fb300a8529ecf9fb2ab65135d99 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "media_list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 7
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("media_menu_item"        ,        );
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
        // line 8
        echo "            </ul>
        </div>
        <div class=\"x_content\">
            <div id=\"actions\">
                <div class=\"btn-group\">
                    <a id=\"mark_adult_select_block\" href=\"javascript:;\" class=\"btn btn-primary\">
                        ";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_mark_adult"        ,"media"        ,        );
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
        echo "</a>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                            aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a id=\"mark_adult_select_block\" href=\"javascript:;\">
                                ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_mark_adult"        ,"media"        ,        );
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
        echo "</a>
                        </li>
                        <li>
                            <a id=\"unmark_adult_select_block\" href=\"javascript:void(0)\">
                                ";
        // line 27
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_unmark_adult"        ,"media"        ,        );
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
        echo "</a>
                        </li>
                        <li>
                            <a id=\"delete_select_block\" href=\"javascript:void(0)\">
                                ";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_link_delete"        ,"media"        ,        );
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
        echo "</a>
                        </li>
                    </ul>
                </div>
\t        </div>
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-group\"><input type=\"checkbox\" id=\"check-all\" class=\"flat\"></th>
                        <th class=\"column-title\">";
        // line 40
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
        // line 41
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
                        <th class=\"column-title\">";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("media_owner"        ,"media"        ,        );
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
                        <th class=\"column-title\">&nbsp;</th>
                        <th class=\"bulk-actions\" colspan=\"4\"></th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["media"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 50
            echo "                    <tr class=\"even pointer";
            if ($this->getAttribute($context["item"], "is_adult", [])) {
                echo " adult";
            }
            echo "\">
                        <td>
                            <input data=\"table_records\" type=\"checkbox\" class=\"flat grouping\"
                                value=\"";
            // line 53
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" id=\"media-";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"></td>
                        <td>
                        ";
            // line 55
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_audio")) {
                // line 56
                echo "                            <audio src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "file_url", []);
                echo "\" controls style=\"max-width: 100%;\"></audio>
                        ";
            } elseif ($this->getAttribute(            // line 57
$context["item"], "media", [])) {
                // line 58
                echo "                            <a href=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "file_url", []);
                echo "\" target=\"_blank\">
                                <img src=\"";
                // line 59
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "thumbs", []), "small", []);
                echo "\"/>
                            </a>
                        ";
            }
            // line 62
            echo "
                        ";
            // line 63
            if ($this->getAttribute($context["item"], "video_content", [])) {
                // line 64
                echo "                            <span onclick=\"vpreview = new loadingContent({'closeBtnClass': 'w'}); vpreview.show_load_block('";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["item"], "video_content", []), "embed", []), "js");
                echo "');\">
                                <img class=\"pointer\" src=\"";
                // line 65
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "video_content", []), "thumbs", []), "small", []);
                echo "\"/>
                            </span>
                        ";
            }
            // line 68
            echo "                        </td>
                        <td>
                            <b>";
            // line 70
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
            // line 71
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
            echo "</b>: ";
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
            echo "<br>
                        </td>
                        <td>
                            ";
            // line 74
            if (call_user_func_array($this->env->getFunction('empty')->getCallable(), [$this->getAttribute($this->getAttribute($context["item"], "owner_info", []), "is_user_deleted", [])])) {
                // line 75
                echo "                                <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute($context["item"], "id_owner", []);
                echo "\" target=\"_blank\">
                                    ";
                // line 76
                echo $this->getAttribute($this->getAttribute($context["item"], "owner_info", []), "output_name", []);
                echo "
                                </a>
                            ";
            } else {
                // line 79
                echo "                                ";
                echo $this->getAttribute($this->getAttribute($context["item"], "owner_info", []), "output_name", []);
                echo "
                            ";
            }
            // line 81
            echo "                        </td>
                        <td class=\"text-center\">
                            ";
            // line 83
            if (($this->getAttribute($context["item"], "is_adult", []) == 0)) {
                // line 84
                echo "                                <span class=\"label label-default\">18+</span>
                            ";
            } else {
                // line 86
                echo "                                <span class=\"label label-danger\">18+</span>
                            ";
            }
            // line 88
            echo "                        </td>
                        <td class=\"icons\" id=\"media_";
            // line 89
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                            <div class=\"btn-group\">
                                <button type=\"button\" class=\"btn btn-primary delete_select_file\" data-id=\"";
            // line 91
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"
                                        onclick=\"javascript:void(0)\">
                                    ";
            // line 93
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_delete_media"            ,"media"            ,            );
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
            // line 94
            echo "                                </button>
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li>
                                        <a class=\"delete_select_file\" data-id=\"";
            // line 102
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"
                                                onclick=\"javascript:void(0)\">
                                            ";
            // line 104
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_delete_media"            ,"media"            ,            );
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
            // line 105
            echo "                                        </a>
                                    </li>
                                    <li>
                                    ";
            // line 108
            if (($this->getAttribute($context["item"], "is_adult", []) == 0)) {
                // line 109
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/media/mark_adult_media/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                                ";
                // line 110
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("mark_adult"                ,"media"                ,                );
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
                // line 111
                echo "                                        </a>
                                    ";
            } else {
                // line 113
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/media/unmark_adult_media/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                            ";
                // line 114
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("unmark_adult"                ,"media"                ,                );
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
                // line 115
                echo "                                        </a>
                                    ";
            }
            // line 117
            echo "                                    </li>
                                    ";
            // line 118
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_image")) {
                // line 119
                echo "                                        <li class=\"moderation-action-js-edit\" onclick=\"";
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
                // line 120
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
                // line 121
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
                // line 122
                echo "                                            </a>

                                        </li>
                                    ";
            }
            // line 126
            echo "                                </ul>
                                ";
            // line 127
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_image")) {
                // line 128
                echo "                                    <script>
                                          \$(function () {
                                              loadScripts(
                                                      \"";
                // line 131
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
                // line 137
                echo $this->getAttribute($context["item"], "id_owner", []);
                echo "',
                                                              all_loaded: 1,
                                                              post_data: {filter_duplicate: 1},
                                                              load_on_scroll: false,
                                                              viewMediaUrl: 'admin/media/ajax_view_media',
                                                              galleryContentDiv: 'media_";
                // line 142
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
            // line 152
            echo "                            </div>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 156
        echo "                </tbody>
            </table>
        </div>
        ";
        // line 159
        $this->loadTemplate("@app/pagination.twig", "media_list.twig", 159)->display($context);
        // line 160
        echo "    </div>
</div>

<script type=\"text/javascript\">
    var reload_link = \"";
        // line 164
        echo ($context["site_url"] ?? null);
        echo "admin/media/\";
    var param = \"";
        // line 165
        echo ($context["param"] ?? null);
        echo "\";

    \$(function() {
        loadScripts(\"";
        // line 168
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
        \$('#grouping_all').on('click', function() {
            var checked = \$(this).is(':checked');
            if (checked) {
                \$('input.grouping').prop('checked', true);
            } else {
                \$('input.grouping').prop('checked', false);
            }
        });

        \$('#grouping_all').on('click', function() {
            var checked = \$(this).is(':checked');
            if (checked) {
                \$('input[type=checkbox].grouping').prop('checked', true);
            } else {
                \$('input[type=checkbox].grouping').prop('checked', false);
            }
        });
    });

    delete_select_block = new loadingContent( {
        loadBlockSize: 'small',
        loadBlockLeftType: 'center',
        loadBlockTopType: 'center',
        closeBtnClass: 'close',
        footerButtons: '<input type=\"submit\" id=\"lie_delete\" name=\"btn_confirm\" value=\"";
        // line 193
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_confirm"        ,"media"        ,        );
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
        echo "\" class=\"btn btn-primary\">'
    });

    \$(document).off('click', '.delete_select_file').on('click', '.delete_select_file', function() {
        var id_media = \$(this).attr('data-id');
        var data = new Array();

        var checked = \$('input#media-'+id_media).is(':checked');
        if (checked) {
            \$('input#media-'+id_media).prop('checked', false);
            \$('input#media-'+id_media).prop('checked', true);
        } else {
            \$('input#media-'+id_media).prop('checked', true);
        }

        data[0] = id_media;

        if (data.length > 0) {
            \$.ajax({
                url: site_url + 'admin/media/ajax_confirm_select/delete_select_block',
                cache: false,
                success: function(data) {
                    delete_select_block.show_load_block(data);
                }
            });
        } else {
            error_object.show_error_block('";
        // line 219
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_media"        ,"media"        ,""        ,"js"        ,        );
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
        echo "', 'error');
        }
    });

    \$(document).off('click', '#delete_select_block').on('click', '#delete_select_block', function() {
        var data = new Array();

        \$('.grouping:checked').each(function(i) {
            data[i] = \$(this).val();
        });

        if (data.length > 0) {
            \$.ajax({
                url: site_url + 'admin/media/ajax_confirm_select/delete_select_block',
                cache: false,
                success: function(data){
                    delete_select_block.show_load_block(data);
                }
            });
        } else {
            error_object.show_error_block('";
        // line 239
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_media"        ,"media"        ,""        ,"js"        ,        );
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
        echo "', 'error');
        }
    });

    \$(document).off('click', '#mark_adult_select_block').on('click', '#mark_adult_select_block', function() {
        var data = new Array();

        \$('.grouping:checked').each(function(i) {
            data[i] = \$(this).val();
        });

        if (data.length > 0) {
            \$.ajax({
                url: site_url + 'admin/media/ajax_mark_adult_select',
                cache: false,
                type: \"POST\",
                data: {file_ids : data},
                success: function(data) {
                    reload_this_page('index/' + param);
                }
            });
        } else {
            error_object.show_error_block('";
        // line 261
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_media"        ,"media"        ,""        ,"js"        ,        );
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
        echo "', 'error');
        }
    });

    \$(document).off('click', '#unmark_adult_select_block').on('click', '#unmark_adult_select_block', function() {
        var data = new Array();

        \$('.grouping:checked').each(function(i) {
            data[i] = \$(this).val();
        });

        if (data.length > 0) {
            \$.ajax({
                url: site_url + 'admin/media/ajax_unmark_adult_select',
                cache: false,
                type: \"POST\",
                data: {file_ids : data},
                success: function(data) {
                    reload_this_page('index/'+param);
                }
            });
        } else {
            error_object.show_error_block('";
        // line 283
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_media"        ,"media"        ,""        ,"js"        ,        );
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
        echo "', 'error');
        }
    });

    function reload_this_page(value) {
        var link = reload_link + value;
        location.href=link;
    }
</script>

";
        // line 293
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-ui.custom.min.js"        ,        );
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
        // line 294
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />
<script type=\"text/javascript\">
    \$(document).ready(function() {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });

    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 307
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
        // line 308
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
                    'aTargets': [0,1,2,4,5]
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
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
        \$('#users_wrapper').find('.actions').html(actions.html());
        actions.remove();
    });
</script>

";
        // line 346
        $this->loadTemplate("@app/footer.twig", "media_list.twig", 346)->display($context);
    }

    public function getTemplateName()
    {
        return "media_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1102 => 346,  1042 => 308,  1019 => 307,  1001 => 294,  980 => 293,  948 => 283,  904 => 261,  860 => 239,  818 => 219,  770 => 193,  723 => 168,  717 => 165,  713 => 164,  707 => 160,  705 => 159,  700 => 156,  691 => 152,  678 => 142,  670 => 137,  642 => 131,  637 => 128,  635 => 127,  632 => 126,  626 => 122,  605 => 121,  593 => 120,  569 => 119,  567 => 118,  564 => 117,  560 => 115,  539 => 114,  532 => 113,  528 => 111,  507 => 110,  500 => 109,  498 => 108,  493 => 105,  472 => 104,  467 => 102,  457 => 94,  436 => 93,  431 => 91,  426 => 89,  423 => 88,  419 => 86,  415 => 84,  413 => 83,  409 => 81,  403 => 79,  397 => 76,  390 => 75,  388 => 74,  342 => 71,  317 => 70,  313 => 68,  307 => 65,  302 => 64,  300 => 63,  297 => 62,  291 => 59,  286 => 58,  284 => 57,  279 => 56,  277 => 55,  270 => 53,  261 => 50,  257 => 49,  228 => 42,  205 => 41,  182 => 40,  151 => 31,  125 => 27,  99 => 23,  68 => 14,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "media_list.twig", "/home/mliadov/public_html/application/modules/media/views/gentelella/media_list.twig");
    }
}
