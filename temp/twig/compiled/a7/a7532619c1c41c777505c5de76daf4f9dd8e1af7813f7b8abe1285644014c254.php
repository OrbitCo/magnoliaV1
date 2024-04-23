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

/* helper_search_form.twig */
class __TwigTemplate_57832f0ace4619f6811d1370a6b34b6c113d594a1578ba7f269f235e26b4cc6d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            '__internal_5cea69862e4fe2bb253754ffc3043030b75c24351966ab95b8a2ef90fef4d8e3' => [$this, 'block___internal_5cea69862e4fe2bb253754ffc3043030b75c24351966ab95b8a2ef90fef4d8e3'],
            '__internal_4a5ceb38d1be5b744f4aed59b652218d187ddb7dbb0d6dd500d59500a5fbf5fe' => [$this, 'block___internal_4a5ceb38d1be5b744f4aed59b652218d187ddb7dbb0d6dd500d59500a5fbf5fe'],
            '__internal_4fff7bacf18d6e8ad44fdc63d16497b1913ae3ab901adbc3d18119dc3c272f4f' => [$this, 'block___internal_4fff7bacf18d6e8ad44fdc63d16497b1913ae3ab901adbc3d18119dc3c272f4f'],
            '__internal_5c81a4616535b08b91f6d8822579cbff9efe149b37e196d8ea5b96e4f0275852' => [$this, 'block___internal_5c81a4616535b08b91f6d8822579cbff9efe149b37e196d8ea5b96e4f0275852'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("select_default"        ,"users"        ,        );
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
        $context['default_select_lang'] = $result;
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all"        ,"users"        ,        );
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
        $context['all_select_lang'] = $result;
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_search_country"        ,"users"        ,        );
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
        $context['location_lang'] = $result;
        // line 4
        echo "<form action=\"";
        echo $this->getAttribute(($context["form_settings"] ?? null), "action", []);
        echo "\" method=\"POST\" id=\"main_search_form_";
        echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
        echo "\">
    <input type=\"hidden\" name=\"main_search_form\" value=\"1\">
    <div class=\"";
        // line 6
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "\">
        ";
        // line 7
        if (($this->getAttribute(($context["form_settings"] ?? null), "type", []) == "line")) {
            // line 8
            echo "        <div class=\"inside\">
            <div id=\"line-search-form_";
            // line 9
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\">
                <input type=\"text\" name=\"search\" placeholder=\"";
            // line 10
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("search_people"            ,"start"            ,            );
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
            echo "\" />
                <button type=\"submit\" id=\"main_search_button_";
            // line 11
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\" class=\"search\"><i class=\"fa-search w\"></i></button>
            </div>
        </div>
        ";
        } elseif (($this->getAttribute(        // line 14
($context["form_settings"] ?? null), "type", []) == "index")) {
            // line 15
            echo "        <div class=\"fields-block aligned-fields\">
            <div id=\"short-search-form_";
            // line 16
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\">
                <div>
                    {hlbox input='user_type' id='looking_user_type' value=\$looking_user_types.option multiselect=true selected=\$data.user_type}
                </div>
                <div class=\"table\">
                    <div class=\"search-fields\">
                        <div class=\"search-field age\">
                            <span class=\"inline vmiddle\">";
            // line 23
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_age"            ,"users"            ,            );
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
            echo "&nbsp;</span>
                            <div class=\"ib vmiddle\">
                                ";
            // line 25
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_min", "id" => "age_min", "value" =>             // line 28
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 29
($context["data"] ?? null), "age_min", [])]            ,            );
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
            // line 31
            echo "                            </div>
                            &nbsp;-&nbsp;
                            <div class=\"ib vmiddle\">
                                ";
            // line 34
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_max", "id" => "age_max", "value" =>             // line 37
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 38
($context["data"] ?? null), "age_max", [])]            ,            );
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
            // line 40
            echo "                            </div>
                        </div>
                        <div class=\"search-field country\">
                            ";
            // line 43
            $module =             null;
            $helper =             'countries';
            $name =             'location_select';
            $params = array(["select_type" => "city", "placeholder" =>             // line 45
($context["location_lang"] ?? null), "id_country" => $this->getAttribute(            // line 46
($context["data"] ?? null), "looking_id_country", []), "id_region" => $this->getAttribute(            // line 47
($context["data"] ?? null), "looking_id_region", []), "id_city" => $this->getAttribute(            // line 48
($context["data"] ?? null), "looking_id_city", [])]            ,            );
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
            echo "                        </div>
                        <div class=\"search-field search-btn righted\">
                            <button type=\"submit\" id=\"main_search_button_";
            // line 52
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\" name=\"search_button\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_search"            ,"start"            ,            );
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
            echo "</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"clr\"></div>
        </div>
        ";
        } else {
            // line 60
            echo "        <div class=\"search-block clearfix\">
            <div class=\"f-title\">
                ";
            // line 62
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_5cea69862e4fe2bb253754ffc3043030b75c24351966ab95b8a2ef90fef4d8e3", $context, $blocks));
            // line 63
            echo "            </div>
            <div class=\"f-block\">
                ";
            // line 65
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "user_type", "id" => "looking_user_type", "value" => $this->getAttribute(            // line 68
($context["looking_user_types"] ?? null), "option", []), "selected" => $this->getAttribute(            // line 69
($context["data"] ?? null), "user_type", []), "default" =>             // line 70
($context["all_select_lang"] ?? null)]            ,            );
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
            // line 72
            echo "            </div>
        </div>
        <div class=\"search-block looking_ages-search_block clearfix\">
            <div class=\"f-title\">
                ";
            // line 76
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_4a5ceb38d1be5b744f4aed59b652218d187ddb7dbb0d6dd500d59500a5fbf5fe", $context, $blocks));
            // line 77
            echo "            </div>
            <div class=\"f-block clearfix looking-age_block\">
                <div class=\"\">
                    ";
            // line 80
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_min", "id" => "age_min", "value" =>             // line 83
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 84
($context["data"] ?? null), "age_min", [])]            ,            );
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
            // line 86
            echo "                </div>
                <div class=\"looking-age_center\">-</div>
                <div class=\"\">
                    ";
            // line 89
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_max", "id" => "age_max", "value" =>             // line 92
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 93
($context["data"] ?? null), "age_max", [])]            ,            );
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
            // line 95
            echo "                </div>
            </div>
        </div>
        <div class=\"search-block clearfix\">
            <div class=\"f-title\">
                ";
            // line 100
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_4fff7bacf18d6e8ad44fdc63d16497b1913ae3ab901adbc3d18119dc3c272f4f", $context, $blocks));
            // line 101
            echo "            </div>
            <div class=\"f-block\">
                <div>
                    ";
            // line 104
            $module =             null;
            $helper =             'countries';
            $name =             'location_select';
            $params = array(["select_type" => "city", "placeholder" =>             // line 106
($context["location_lang"] ?? null), "id_country" => $this->getAttribute(            // line 107
($context["data"] ?? null), "looking_id_country", []), "id_region" => $this->getAttribute(            // line 108
($context["data"] ?? null), "looking_id_region", []), "id_city" => $this->getAttribute(            // line 109
($context["data"] ?? null), "looking_id_city", [])]            ,            );
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
            echo "                </div>
            </div>
        </div>
        <div id=\"full-search-form_";
            // line 114
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\" ";
            if (($this->getAttribute(($context["form_settings"] ?? null), "type", []) == "short")) {
                echo "class=\"hide\"";
            }
            echo ">
            ";
            // line 115
            if ($this->getAttribute(($context["form_settings"] ?? null), "use_advanced", [])) {
                // line 116
                echo "                <div class=\"clr\"></div>
                ";
                // line 117
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["advanced_form"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 118
                    echo "                    ";
                    if (($this->getAttribute($context["item"], "type", []) == "section")) {
                        // line 119
                        echo "                        ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "section", []), "fields", []));
                        $context['loop'] = [
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        ];
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                            // line 120
                            echo "                            <div class=\"search-field custom ";
                            echo $this->getAttribute($this->getAttribute($context["field"], "field", []), "type", []);
                            echo " ";
                            echo $this->getAttribute($this->getAttribute($context["field"], "settings", []), "search_type", []);
                            echo "\">
                                <p>";
                            // line 121
                            echo $this->getAttribute($this->getAttribute($context["field"], "field_content", []), "name", []);
                            echo "</p>
                                ";
                            // line 122
                            $this->loadTemplate("helper_search_field_block.twig", "helper_search_form.twig", 122)->display(twig_array_merge($context, ["field" =>                             // line 123
$context["field"], "field_name" => $this->getAttribute($this->getAttribute(                            // line 124
$context["field"], "field_content", []), "field_name", [])]));
                            // line 126
                            echo "                            </div>
                        ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 128
                        echo "                    ";
                    } else {
                        // line 129
                        echo "                        <div class=\"search-field custom ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "field", []), "type", []);
                        echo " ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "settings", []), "search_type", []);
                        echo "\">
                            <p>";
                        // line 130
                        echo $this->getAttribute($this->getAttribute($context["item"], "field_content", []), "name", []);
                        echo "</p>
                            ";
                        // line 131
                        $this->loadTemplate("helper_search_field_block.twig", "helper_search_form.twig", 131)->display(twig_array_merge($context, ["field" =>                         // line 132
$context["item"], "field_name" => $this->getAttribute($this->getAttribute(                        // line 133
$context["item"], "field_content", []), "field_name", [])]));
                        // line 135
                        echo "                        </div>
                    ";
                    }
                    // line 137
                    echo "                ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 138
                echo "            ";
            }
            // line 139
            echo "        </div>
        <div class=\"search-block clearfix\">
            <div class=\"f-title\">";
            // line 141
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_5c81a4616535b08b91f6d8822579cbff9efe149b37e196d8ea5b96e4f0275852", $context, $blocks));
            echo "</div>
            <div class=\"f-block\">
                <input type=\"checkbox\" name=\"online_status\" class=\"hide\" id=\"online_status\">
                <script>
                    \$(function () {
                        if (\$('.bootstrap-switch-container').find('input').is('#online_status') === false) {
                            if (typeof \$.fn.bootstrapSwitch == \"undefined\") {
                                loadScripts([
                                    \"";
            // line 149
            echo ($context["site_url"] ?? null);
            echo "application/js/bootstrap/bootstrap.min.js\",
                                    \"";
            // line 150
            echo ($context["site_url"] ?? null);
            echo "application/js/bootstrap-switch/dist/js/bootstrap-switch.min.js\"
                                ]);
                            }
                            var load_script = setInterval(function() {
                                if (typeof \$.fn.bootstrapSwitch !== \"undefined\") {
                                    \$(\"#online_status\").bootstrapSwitch().show();
                                    clearInterval(load_script);
                                }
                            }, 300);
                        }
                    });
                </script>
            </div>
        </div>
        <div class=\"search-block clearfix\">
            <input name=\"main_search_button\" type=\"button\" id=\"main_search_button_";
            // line 165
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\" class=\"btn btn-primary\" value=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_search"            ,"start"            ,            );
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
            ";
            // line 166
            if ($this->getAttribute(($context["form_settings"] ?? null), "use_advanced", [])) {
                // line 167
                echo "                <span class=\"collapse-links ml10\">
                    <a href=\"#\" class=\"hide\" id=\"more-options-link_";
                // line 168
                echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
                echo "\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_more_options"                ,"start"                ,                );
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
                echo "&nbsp;<i class=\"fa fa-caret-down icon-big text-icon\"></i></a>
                    <a href=\"#\" class=\"hide\" id=\"less-options-link_";
                // line 169
                echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
                echo "\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_less_options"                ,"start"                ,                );
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
                echo "&nbsp;<i class=\"fa fa-caret-up icon-big text-icon\"></i></a>
                </span>
                &nbsp;&nbsp;&nbsp;
            ";
            }
            // line 173
            echo "        </div>
        ";
        }
        // line 175
        echo "    <div class=\"clearfix\"></div>
    </div>
</form>
";
    }

    // line 62
    public function block___internal_5cea69862e4fe2bb253754ffc3043030b75c24351966ab95b8a2ef90fef4d8e3($context, array $blocks = [])
    {
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_gender"        ,"users"        ,        );
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
    }

    // line 76
    public function block___internal_4a5ceb38d1be5b744f4aed59b652218d187ddb7dbb0d6dd500d59500a5fbf5fe($context, array $blocks = [])
    {
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_ages"        ,"users"        ,        );
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
    }

    // line 100
    public function block___internal_4fff7bacf18d6e8ad44fdc63d16497b1913ae3ab901adbc3d18119dc3c272f4f($context, array $blocks = [])
    {
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_location"        ,"users"        ,        );
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
    }

    // line 141
    public function block___internal_5c81a4616535b08b91f6d8822579cbff9efe149b37e196d8ea5b96e4f0275852($context, array $blocks = [])
    {
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("online_now"        ,"users"        ,        );
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
    }

    public function getTemplateName()
    {
        return "helper_search_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  771 => 141,  746 => 100,  721 => 76,  696 => 62,  689 => 175,  685 => 173,  657 => 169,  632 => 168,  629 => 167,  627 => 166,  602 => 165,  584 => 150,  580 => 149,  569 => 141,  565 => 139,  562 => 138,  548 => 137,  544 => 135,  542 => 133,  541 => 132,  540 => 131,  536 => 130,  529 => 129,  526 => 128,  511 => 126,  509 => 124,  508 => 123,  507 => 122,  503 => 121,  496 => 120,  478 => 119,  475 => 118,  458 => 117,  455 => 116,  453 => 115,  445 => 114,  440 => 111,  422 => 109,  421 => 108,  420 => 107,  419 => 106,  415 => 104,  410 => 101,  408 => 100,  401 => 95,  383 => 93,  382 => 92,  378 => 89,  373 => 86,  355 => 84,  354 => 83,  350 => 80,  345 => 77,  343 => 76,  337 => 72,  319 => 70,  318 => 69,  317 => 68,  313 => 65,  309 => 63,  307 => 62,  303 => 60,  271 => 52,  267 => 50,  249 => 48,  248 => 47,  247 => 46,  246 => 45,  242 => 43,  237 => 40,  219 => 38,  218 => 37,  214 => 34,  209 => 31,  191 => 29,  190 => 28,  186 => 25,  162 => 23,  152 => 16,  149 => 15,  147 => 14,  141 => 11,  118 => 10,  114 => 9,  111 => 8,  109 => 7,  105 => 6,  97 => 4,  76 => 3,  55 => 2,  34 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_search_form.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_search_form.twig");
    }
}
