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

/* users_list.twig */
class __TwigTemplate_5e61723da80c21df1e1df3043f24a42d0602ef5f7446a1215785d55f750c0e96 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "users_list.twig", 1)->display($context);
        // line 2
        echo "
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '6897243193627173');
fbq('track', 'PageView');
</script>
<noscript><img height=\"1\" width=\"1\" style=\"display:none\"
src=\"https://www.facebook.com/tr?id=6897243193627173&ev=PageView&noscript=1\"
/></noscript>
<!-- End Meta Pixel Code -->

<div class=\"search-header clearfix\">
    <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
        <h1 class=\"title\">
            ";
        // line 24
        if (($context["search_text"] ?? null)) {
            // line 25
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("search_results"            ,"users"            ,            );
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
                '";
            // line 26
            echo ($context["search_text"] ?? null);
            echo "'
            ";
        } else {
            // line 28
            echo "                ";
            $module =             null;
            $helper =             'seo';
            $name =             'seo_tags';
            $params = array("header_text"            ,            );
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
            // line 29
            echo "            ";
        }
        // line 30
        echo "        </h1>
        <div class=\"view-search-menu btn-group\">
            <a href=\"javascript:void(0);\" class=\"btn btn-default  ";
        // line 32
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "list")) {
            echo "active";
        }
        echo "\" onclick=\"changeViewType('list');\" title=\"";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_list_view"        ,"users"        ,""        ,"button"        ,        );
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
                <i class=\"fa fa-bars\"></i>&nbsp;";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_list_view"        ,"users"        ,        );
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
        // line 34
        echo "            </a>
            <a href=\"javascript:void(0);\" class=\"btn btn-default  ";
        // line 35
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "gallery")) {
            echo "active";
        }
        echo "\" onclick=\"changeViewType('gallery');\" title=\"";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_gallery_view"        ,"users"        ,        );
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
                <i class=\"fa fa-th-large\"></i>&nbsp;";
        // line 36
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_gallery_view"        ,"users"        ,        );
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
        // line 37
        echo "            </a>
        </div>
    </div>
</div>

<div class=\"content-block\">
    <div class=\"user-search\">
        
        <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
            <div class=\"search-param-button mb10\"><a>";
        // line 46
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_params_button"        ,"users"        ,        );
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
        echo "</a></div>
            <div class=\"search-form\">
              ";
        // line 48
        $module =         null;
        $helper =         'utils';
        $name =         'startSearchForm';
        $params = array(["type" => "advanced", "show_data" => "1", "object" => "user", "params_data" => ["view" => "horizontal", "hide_popup" => 1, "is_full_page" => ($context["is_full_page"] ?? null)]]        ,        );
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
        // line 49
        echo "            </div>

            <div class=\"users-sort ";
        // line 51
        if (($this->getAttribute(($context["page_data"] ?? null), "total_rows", []) == 0)) {
            echo " hide";
        }
        echo "\">
                <span data-action=\"sort-by\"  data-sort=\"date_created\" class=\"active\">";
        // line 52
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_newest"        ,"users"        ,        );
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
        echo "</span>
                <span data-action=\"sort-by\" data-sort=\"date_last_activity\">";
        // line 53
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_latest_active"        ,"users"        ,        );
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
        echo "</span>
            </div>

            <div class=\"search-result\">
                ";
        // line 57
        if ($this->getAttribute($this->getAttribute(($context["hl_data"] ?? null), "service_highlight", []), "status", [])) {
            // line 58
            echo "                    <div id=\"hl_service_container\">
                        <button class=\"btn btn-algnleft\" onclick=\"highlight_in_search_available_view.check_available();\">
                            <img src=\"";
            // line 60
            echo ($context["site_root"] ?? null);
            echo ($context["img_folder"] ?? null);
            echo "icons/ic-light-bulb.svg\" height=\"24px\" alt=\"\"><span>";
            echo $this->getAttribute($this->getAttribute(($context["hl_data"] ?? null), "service_highlight", []), "description", []);
            echo "</span>
                        </button>
                    </div>
                    <script>
                        \$(function () {
                            loadScripts(
                                \"";
            // line 66
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"available_view.js"            ,"path"            ,            );
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
                                    highlight_in_search_available_view = new available_view({
                                        siteUrl: site_url,
                                        checkAvailableAjaxUrl: 'users/ajax_available_highlight_in_search/',
                                        buyAbilityAjaxUrl: 'users/ajax_activate_highlight_in_search/',
                                        buyAbilityFormId: 'ability_form',
                                        buyAbilitySubmitId: 'ability_form_submit',
                                        formType: 'list',
                                        success_request: function (message) {
                                            error_object.show_error_block(message, 'success');
                                            \$('#hl_service_container').remove();
                                        },
                                        fail_request: function (message) {
                                            error_object.show_error_block(message, 'error');
                                        },
                                    });
                                },
                                ['highlight_in_search_available_view'],
                                {async: false}
                            );
                        });
                    </script>
                ";
        }
        // line 90
        echo "                <div id=\"main_users_results\">";
        echo ($context["block"] ?? null);
        echo "</div>
                <div class=\"scrolltop fixed\" data-id=\"pjaxcontainer\" data-action=\"scroll-to-top\">
                    <button class=\"btn btn-primary btn-large btn-block\" title=\"";
        // line 92
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_back_to_top"        ,"menu"        ,        );
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
                        <i class=\"fa fa-arrow-up\" aria-hidden=\"true\"></i>
                    </button>
                </div>
            </div>

            <script>
                \$(function () {
                    loadScripts(
                            [\"";
        // line 101
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users"        ,"users-list.js"        ,"path"        ,        );
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
                            function () {
                                users_list = new usersList({
                                    siteUrl: \"";
        // line 104
        echo ($context["site_url"] ?? null);
        echo "\",
                                    viewUrl: \"";
        // line 105
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,""        ,        );
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
                                    viewAjaxUrl: \"";
        // line 106
        echo ($context["site_url"] ?? null);
        echo "users/ajax_search/\",
                                    listBlockId: 'main_users_results',
                                    tIds: ['pages_block_1', 'pages_block_2', 'sorter_block'],
                                    formCallback : function () {
                                        if (typeof users_search === 'object' && typeof users_search.reset === 'function') {
                                            users_search.reset();
                                            \$(users_search.properties.dataAction.sortBy).removeClass('active');
                                            \$('[data-sort=\"date_created\"]').addClass('active');
                                        }
                                    }
                                });
                            },
                            ['users_list']
                            );
                });

                function changeViewType(type) {
                    var url = \"";
        // line 123
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"set_view_mode"        ,        );
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
        echo "/\" + type;

                    \$.ajax({
                        url: url,
                        type: 'GET',
                        cache: false,
                        success: function (data) {
                            locationHref('";
        // line 130
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"search"        ,        );
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
        echo "');
                        }
                    });
                }

                \$('.search-param-button').click(function () {
                    \$('.user-search .search-form').toggle();
                });
            </script>
        </div>
    </div>
</div>
";
        // line 142
        $this->loadTemplate("@app/footer.twig", "users_list.twig", 142)->display($context);
    }

    public function getTemplateName()
    {
        return "users_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  566 => 142,  532 => 130,  503 => 123,  483 => 106,  460 => 105,  456 => 104,  431 => 101,  400 => 92,  394 => 90,  348 => 66,  336 => 60,  332 => 58,  330 => 57,  304 => 53,  281 => 52,  275 => 51,  271 => 49,  250 => 48,  226 => 46,  215 => 37,  194 => 36,  167 => 35,  164 => 34,  143 => 33,  116 => 32,  112 => 30,  109 => 29,  87 => 28,  82 => 26,  58 => 25,  56 => 24,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "users_list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\users_list.twig");
    }
}
