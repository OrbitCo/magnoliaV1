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

/* list.twig */
class __TwigTemplate_4c87a125a38e4a542ea01e0e38db8714438ae00e2431a9902d298524edb71389 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-xs-12\">
    <h1>";
        // line 4
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("header_text"        ,        );
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
        echo "</h1>
</div>

<!--Profile -->
<div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">
    <div class=\"hide-in-mobile\">
        ";
        // line 10
        $module =         null;
        $helper =         'users';
        $name =         'get_preview';
        $params = array(        );
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
        // line 11
        echo "        ";
        $module =         null;
        $helper =         'media';
        $name =         'user_media_block';
        $params = array(["count" => 9, "user_id" => ($context["user_id"] ?? null)]        ,        );
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
        // line 12
        echo "    </div>
</div>
<!--Profile -->

<div class=\"col-xs-12 col-sm-9 col-md-6 col-lg-6\">
    <div class=\"b-winks\">
        <div class=\"b-winks__top\">
            ";
        // line 19
        $this->loadTemplate("list_top_panel.twig", "list.twig", 19)->display($context);
        // line 20
        echo "        </div>

        ";
        // line 22
        if (($this->getAttribute(($context["page_data"] ?? null), "total_rows", []) > $this->getAttribute(($context["page_data"] ?? null), "per_page", []))) {
            // line 23
            echo "            <div class=\"sorter short-line\" id=\"sorter_block\">
                <div class=\"fright\">
                    ";
            // line 25
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "cute"]);
            // line 26
            echo "                    ";
            $module =             null;
            $helper =             'start';
            $name =             'pagination';
            $params = array(($context["page_data"] ?? null)            ,            );
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
            // line 27
            echo "                </div>
            </div>
        ";
        }
        // line 30
        echo "        <div id=\"winks-list\" class=\"b-winks__list\">
            <div class=\"media b-winks__item hide-always wink\" id=\"wink-_user-id_\" data-user-id=\"_user-id_\">
                <div class=\"media-left\">
                    <a class=\"g-pic-border g-rounded\"  title=\"_user-name_\" href=\"_user-link_\">[img]</a>
                </div>
                <div class=\"media-body\">
                    <div class=\"b-winks__name\">
                        <a title=\"_user-name_\" href=\"_user-link_\">_user-name_</a>
                    </div>
                    <div class=\"b-winks__actions\">
                        <a class=\"btn-wink btn btn-primary-inverted\" data-user-id=\"_user-id_\" data-is-new=\"true\"
                            href=\"javascript:void(0);\">
                            ";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("wink"        ,"winks"        ,        );
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
        // line 43
        echo "                        </a>
                    </div>
                </div>
            </div>

            ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["winks"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 49
            echo "                <div class=\"media b-winks__item wink ";
            if (($this->getAttribute($context["item"], "type", []) == "replied")) {
                echo "replied-winks";
            }
            echo "\" id=\"wink-";
            echo $this->getAttribute($context["item"], "id_from", []);
            echo "\" data-user-id=\"";
            echo $this->getAttribute($context["item"], "id_from", []);
            echo "\">
                    <div class=\"media-left\">
                        <a class=\"g-pic-border g-rounded\" title=\"";
            // line 51
            echo $this->getAttribute($this->getAttribute($context["item"], "from", []), "output_name", []);
            echo "\" href=\"";
            echo $this->getAttribute($this->getAttribute($context["item"], "from", []), "link", []);
            echo "\">
                            <img class=\"media-object\" src=\"";
            // line 52
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "from", []), "media", []), "user_logo", []), "thumbs", []), "small", []);
            echo "\"
                                 alt=\"";
            // line 53
            echo $this->getAttribute($this->getAttribute($context["item"], "from", []), "output_name", []);
            echo "\">
                        </a>
                    </div>
                    <div class=\"media-body\">
                        <div class=\"b-winks__name\">
                            <a title=\"";
            // line 58
            echo strip_tags($this->getAttribute($this->getAttribute($context["item"], "from", []), "output_name", []));
            echo "\" href=\"#\" data-action=\"set_user_ids\" data-gid=\"winks\" data-href=\"";
            echo $this->getAttribute($this->getAttribute($context["item"], "from", []), "link", []);
            echo "\">";
            echo $this->getAttribute($this->getAttribute($context["item"], "from", []), "output_name", []);
            echo "</a> ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("winked_at_you"            ,"winks"            ,            );
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
            // line 59
            echo "                        </div>
                        <div class=\"b-winks__date\">";
            // line 60
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["item"] ?? null), "date", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
            echo "</div>
                        <div class=\"b-winks__actions\">
                            <a class=\"btn-wink-back btn btn-primary-inverted\" ";
            // line 62
            if (($this->getAttribute($context["item"], "type", []) == "deleted")) {
                echo " disabled=\"disabled\" ";
            } else {
                echo "data-user-id=\"";
                echo $this->getAttribute($context["item"], "id_from", []);
                echo "\" href=\"javascript:void(0);\"";
            }
            echo ">
                               ";
            // line 63
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wink_back"            ,"winks"            ,            );
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
            // line 64
            echo "                            </a>
                        </div>
                        <a class=\"btn-wink-ignore b-winks__remove\" data-user-id=\"";
            // line 66
            echo $this->getAttribute($context["item"], "id_from", []);
            echo "\" href=\"javascript:void(0);\"
                           title=\"";
            // line 67
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("wink_ignore"            ,"winks"            ,            );
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
                            <i class=\"fa fa-times\"></i>
                        </a>
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "        </div>

        ";
        // line 75
        if (($this->getAttribute(($context["page_data"] ?? null), "total_rows", []) > $this->getAttribute(($context["page_data"] ?? null), "per_page", []))) {
            // line 76
            echo "            <div>
                ";
            // line 77
            $context["page_data"] = twig_array_merge(($context["page_data"] ?? null), ["type" => "full"]);
            // line 78
            echo "                ";
            $module =             null;
            $helper =             'start';
            $name =             'pagination';
            $params = array(($context["page_data"] ?? null)            ,            );
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
            // line 79
            echo "            </div>
        ";
        }
        // line 81
        echo "
        <div id=\"no-winks\" class=\"b-winks__null ";
        // line 82
        if (($context["winks"] ?? null)) {
            echo " hide";
        }
        echo "\">
            <p>
                ";
        // line 84
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("welcome_text"        ,"winks"        ,        );
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
        echo ":
            </p>
            <p>
                <button id=\"winks-search-button\" type=\"button\" class='btn btn-primary'>
                    ";
        // line 88
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_search"        ,"winks"        ,        );
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
        // line 89
        echo "                </button>
            </p>
        </div>

    </div>
</div>

<script type=\"text/javascript\">
    \$(function(){
        loadScripts(
            [\"";
        // line 99
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("winks"        ,"winks.js"        ,"path"        ,        );
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
        echo "\"],
            function(){
                winksObj = new winks({
                    siteUrl: site_url,
                    titleWink: \"";
        // line 103
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("wink"        ,"winks"        ,""        ,"js"        ,        );
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
                    titleWinkBack: \"";
        // line 104
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("wink_back"        ,"winks"        ,""        ,"js"        ,        );
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
                    errIsPending: \"";
        // line 105
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_is_pending"        ,"winks"        ,""        ,"js"        ,        );
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
                    errIsOnList: \"";
        // line 106
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_is_on_list"        ,"winks"        ,""        ,"js"        ,        );
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
                    succIgnored: \"";
        // line 107
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("msg_ignored"        ,"winks"        ,""        ,"js"        ,        );
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
                    succWinked: \"";
        // line 108
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("msg_winked"        ,"winks"        ,""        ,"js"        ,        );
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
                    succResponded: \"";
        // line 109
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("msg_responded"        ,"winks"        ,""        ,"js"        ,        );
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
                });
            },
            'winksObj',
            {async: false}
        );
    });
</script>

<div class=\"col-xs-12 col-sm-9 col-md-3 col-lg-3 pull-right\">
    <div id=\"active_users\" class=\"clearfix mb10\">
        ";
        // line 120
        $module =         null;
        $helper =         'users';
        $name =         'active_users_block';
        $params = array(["count" => "16"]        ,        );
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
        // line 121
        echo "    </div>
    <div id=\"recent_photo\" class=\"clearfix mb10\">
        ";
        // line 123
        $module =         null;
        $helper =         'media';
        $name =         'recent_media_block';
        $params = array(["upload_gid" => "photo", "count" => "16"]        ,        );
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
        // line 124
        echo "    </div>
</div>

";
        // line 127
        $this->loadTemplate("@app/footer.twig", "list.twig", 127)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  711 => 127,  706 => 124,  685 => 123,  681 => 121,  660 => 120,  627 => 109,  604 => 108,  581 => 107,  558 => 106,  535 => 105,  512 => 104,  489 => 103,  463 => 99,  451 => 89,  430 => 88,  404 => 84,  397 => 82,  394 => 81,  390 => 79,  368 => 78,  366 => 77,  363 => 76,  361 => 75,  357 => 73,  326 => 67,  322 => 66,  318 => 64,  297 => 63,  287 => 62,  263 => 60,  260 => 59,  233 => 58,  225 => 53,  221 => 52,  215 => 51,  203 => 49,  199 => 48,  192 => 43,  171 => 42,  157 => 30,  152 => 27,  130 => 26,  128 => 25,  124 => 23,  122 => 22,  118 => 20,  116 => 19,  107 => 12,  85 => 11,  64 => 10,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/winks/views/flatty/list.twig");
    }
}
