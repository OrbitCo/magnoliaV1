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
class __TwigTemplate_c53b2964a5f3e9ed1d03385351eca545ee1342ddc4d18cd14177e1f626982fc3 extends \Twig\Template
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
<div class=\"search-header clearfix\">
    <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
        <h1 class=\"title\">
            ";
        // line 6
        if (($context["search_text"] ?? null)) {
            // line 7
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
            // line 8
            echo ($context["search_text"] ?? null);
            echo "'
            ";
        } else {
            // line 10
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
            // line 11
            echo "            ";
        }
        // line 12
        echo "        </h1>
        <div class=\"view-search-menu btn-group\">
            <a href=\"javascript:void(0);\" class=\"btn btn-default ";
        // line 14
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "list")) {
            echo " active ";
        }
        echo " \" onclick=\"changeViewType('list');\" title=\"";
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
        echo "\">
                <i class=\"fa fa-bars\"></i>&nbsp;";
        // line 15
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
        echo "</a>
            <a href=\"javascript:void(0);\" class=\"btn btn-default  ";
        // line 16
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "gallery")) {
            echo " active ";
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
        // line 17
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
        echo "</a>
        </div>
    </div>
</div>

<div class=\"content-block\">
    <div class=\"user-search\">
                <div class=\"col-xs-12 ";
        // line 24
        if (($this->getAttribute(($context["form_settings"] ?? null), "view", []) == "horizontal")) {
            echo "col-md-12";
        } else {
            echo "col-md-3";
        }
        echo "\">
                    <div class=\"search-param-button mb10\"><a>";
        // line 25
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
                        <script>
                            selects = [];
                            checkboxes = [];
                            hlboxes = [];
                            selectbox = [];
                            radios = [];
                            multiselects = [];
                        </script>
                        ";
        // line 35
        echo ($context["perfect_match_form"] ?? null);
        echo "
                        <script>
                            \$(function(){
                                loadScripts(
                                    [
                                        \"";
        // line 40
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"search.js"        ,"path"        ,        );
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
                                        \"";
        // line 41
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"checkbox.js"        ,"path"        ,        );
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
                                        \"";
        // line 42
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"selectbox.js"        ,"path"        ,        );
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
                                        \"";
        // line 43
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"hlbox.js"        ,"path"        ,        );
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
                                        \"";
        // line 44
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"radio.js"        ,"path"        ,        );
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
                                        \"";
        // line 45
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("start"        ,"multiselect.js"        ,"path"        ,        );
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
                                    ],
                                    function() {
                                        window.";
        // line 48
        echo $this->getAttribute(($context["form_settings"] ?? null), "object", []);
        echo "_";
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo " = new search({
                                            siteUrl: '";
        // line 49
        echo ($context["site_url"] ?? null);
        echo "',
                                            currentForm: '";
        // line 50
        echo $this->getAttribute(($context["form_settings"] ?? null), "object", []);
        echo "',
                                            currentFormType: '";
        // line 51
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "',
                                            hide_popup: false,
                                            popup_autoposition: false,
                                            userFormUrl: '";
        // line 54
        echo $this->getAttribute(($context["form_settings"] ?? null), "form_url", []);
        echo "',
                                            userSearchUrl: '";
        // line 55
        echo $this->getAttribute(($context["form_settings"] ?? null), "search_url", []);
        echo "',
                                            userCountUrl: '";
        // line 56
        echo $this->getAttribute(($context["form_settings"] ?? null), "count_url", []);
        echo "'
                                        });
                                    },
                                    ['";
        // line 59
        echo $this->getAttribute(($context["form_settings"] ?? null), "object", []);
        echo "_";
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "'],
                                    {async: false}
                                );
                            });
                        </script>
                    </div>
                </div>
                <div class=\"col-xs-12 ";
        // line 66
        if (($this->getAttribute(($context["form_settings"] ?? null), "view", []) == "horizontal")) {
            echo "col-md-12";
        } else {
            echo "col-md-9";
        }
        echo "\">
                    <div class=\"g-flatty-block\" id=\"main_users_results\">
                        ";
        // line 68
        echo ($context["block"] ?? null);
        echo "
                    </div>
                    <script>
                        \$(function(){
                            loadScripts(
                                \"";
        // line 73
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
        echo "\",
                                function() {
                                    users_list = new usersList({
                                        siteUrl: \"";
        // line 76
        echo ($context["site_url"] ?? null);
        echo "\",
                                        viewUrl: \"";
        // line 77
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("perfect_match"        ,""        ,        );
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
        // line 78
        echo ($context["site_url"] ?? null);
        echo "perfect_match/ajaxSearch/\",
                                        listBlockId: 'main_users_results',
                                        tIds: ['pages_block_1', 'pages_block_2', 'sorter_block']
                                    });
                                },
                                'users_list'
                            );
                        });

                        function changeViewType(type) {
                            var url = '";
        // line 88
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("perfect_match"        ,"set_view_mode"        ,        );
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
        echo "/' + type;
                            \$.ajax({
                                url: url,
                                type: 'GET',
                                cache: false,
                                success: function(data) {
                                    locationHref('";
        // line 94
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("perfect_match"        ,"search"        ,        );
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

                        \$('.search-param-button').click(function(){
                            \$('.user-search .search-form').toggle();
                        });
                    </script>
                </div>
            </div>
        </div>


    </div>
</div>
";
        // line 110
        $this->loadTemplate("@app/footer.twig", "list.twig", 110)->display($context);
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
        return array (  586 => 110,  548 => 94,  520 => 88,  507 => 78,  484 => 77,  480 => 76,  455 => 73,  447 => 68,  438 => 66,  426 => 59,  420 => 56,  416 => 55,  412 => 54,  406 => 51,  402 => 50,  398 => 49,  392 => 48,  367 => 45,  344 => 44,  321 => 43,  298 => 42,  275 => 41,  252 => 40,  244 => 35,  212 => 25,  204 => 24,  175 => 17,  148 => 16,  125 => 15,  98 => 14,  94 => 12,  91 => 11,  69 => 10,  64 => 8,  40 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/perfect_match/views/flatty/list.twig");
    }
}
