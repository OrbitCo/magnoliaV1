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

/* helper_search_form_horizontal.twig */
class __TwigTemplate_bbb802f82a250200734d7bf62b3a52919e5415ee0e98e90c32b112cd3659c4ba extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            '__internal_a5cb22fe69987f90c049f880545268b4be1e2e8d6d867220062eeefc439550d7' => [$this, 'block___internal_a5cb22fe69987f90c049f880545268b4be1e2e8d6d867220062eeefc439550d7'],
            '__internal_c366d7e4542c1496a3c309814367b128b7bd8a01d1e8931c7fb7bcb0d53d2aeb' => [$this, 'block___internal_c366d7e4542c1496a3c309814367b128b7bd8a01d1e8931c7fb7bcb0d53d2aeb'],
            '__internal_fea2b96cba22ca1f85c48797374a255202bbc71d0b0caa0dbaa3c7a892761af1' => [$this, 'block___internal_fea2b96cba22ca1f85c48797374a255202bbc71d0b0caa0dbaa3c7a892761af1'],
            '__internal_75229d8aa9e6d2a526e4485397d82cf1c36cc6070a357ce5201dc5be05ddf02b' => [$this, 'block___internal_75229d8aa9e6d2a526e4485397d82cf1c36cc6070a357ce5201dc5be05ddf02b'],
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
        echo "
<div class=\"horizontal_main_search_form\">
    <form action=\"";
        // line 6
        echo $this->getAttribute(($context["form_settings"] ?? null), "action", []);
        echo "\" method=\"POST\" id=\"main_search_form_";
        echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
        echo "\">
        <input type=\"hidden\" name=\"main_search_form\" value=\"1\">
        <div class=\"";
        // line 8
        echo $this->getAttribute(($context["form_settings"] ?? null), "type", []);
        echo "\">
            ";
        // line 9
        if (($this->getAttribute(($context["form_settings"] ?? null), "type", []) == "line")) {
            // line 10
            echo "                <div class=\"inside\">
                    <div id=\"line-search-form_";
            // line 11
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\">
                        <input type=\"text\" name=\"search\" placeholder=\"";
            // line 12
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
            // line 13
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\" class=\"search\"><i class=\"fa-search w\"></i></button>
                    </div>
                </div>
            ";
        } elseif (($this->getAttribute(        // line 16
($context["form_settings"] ?? null), "type", []) == "index")) {
            // line 17
            echo "                <div class=\"fields-block aligned-fields\">
                    <div id=\"short-search-form_";
            // line 18
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\">
                        <div>
                            {hlbox input='user_type' id='looking_user_type' value=\$looking_user_types.option multiselect=true selected=\$data.user_type}
                        </div>
                        <div class=\"table\">
                            <div class=\"search-fields\">
                                <div class=\"search-field age\">
                                    <span class=\"inline vmiddle\">";
            // line 25
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
            // line 27
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_min", "id" => "age_min", "value" =>             // line 30
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 31
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
            // line 33
            echo "                                    </div>
                                    &nbsp;-&nbsp;
                                    <div class=\"ib vmiddle\">
                                        ";
            // line 36
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_max", "id" => "age_max", "value" =>             // line 39
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 40
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
            // line 42
            echo "                                    </div>
                                </div>
                                <div class=\"search-field country\">
                                    ";
            // line 45
            $module =             null;
            $helper =             'countries';
            $name =             'locationSelect';
            $params = array(["select_type" => "city", "placeholder" =>             // line 47
($context["location_lang"] ?? null), "id_country" => $this->getAttribute(            // line 48
($context["data"] ?? null), "looking_id_country", []), "id_region" => $this->getAttribute(            // line 49
($context["data"] ?? null), "looking_id_region", []), "id_city" => $this->getAttribute(            // line 50
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
            // line 52
            echo "                                </div>
                                <div class=\"search-field search-btn righted\">
                                    <button type=\"submit\" id=\"main_search_button_";
            // line 54
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
            // line 62
            echo "                <div class=\"clearfix\">
                    <div class=\"fline\">
                        <div class=\"fline__item user_types-search_block\">
                            <div class=\"f-title\">
                                ";
            // line 66
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_a5cb22fe69987f90c049f880545268b4be1e2e8d6d867220062eeefc439550d7", $context, $blocks));
            // line 67
            echo "                            </div>
                            <div class=\"f-block\">
                                ";
            // line 69
            $module =             null;
            $helper =             'start';
            $name =             'checkbox';
            $params = array(["input" => "user_type", "id" => "looking_user_type", "value" => $this->getAttribute(            // line 72
($context["looking_user_types"] ?? null), "option", []), "selected" => $this->getAttribute(            // line 73
($context["data"] ?? null), "user_type", []), "default" =>             // line 74
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
            // line 76
            echo "                            </div>
                        </div>
                        <div class=\"fline__item looking_ages-search_block\">
                            <div class=\"f-title\">
                                ";
            // line 80
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_c366d7e4542c1496a3c309814367b128b7bd8a01d1e8931c7fb7bcb0d53d2aeb", $context, $blocks));
            // line 81
            echo "                            </div>
                            <div class=\"f-block clearfix looking-age_block\">
                                <div class=\"\">
                                    ";
            // line 84
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_min", "id" => "age_min", "value" =>             // line 87
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 88
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
            // line 90
            echo "                                </div>
                                <div class=\"looking-age_center\">-</div>
                                <div class=\"\">
                                    ";
            // line 93
            $module =             null;
            $helper =             'start';
            $name =             'selectbox';
            $params = array(["input" => "age_max", "id" => "age_max", "value" =>             // line 96
($context["age_range"] ?? null), "selected" => $this->getAttribute(            // line 97
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
            // line 99
            echo "                                </div>
                            </div>
                        </div>
                        <div class=\"fline__item location-search_block\">
                            <div class=\"f-title\">
                                ";
            // line 104
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_fea2b96cba22ca1f85c48797374a255202bbc71d0b0caa0dbaa3c7a892761af1", $context, $blocks));
            // line 105
            echo "                            </div>
                            <div class=\"f-block\">
                                <div>
                                    ";
            // line 108
            $module =             null;
            $helper =             'countries';
            $name =             'location_select';
            $params = array(["is_radius" => 1, "is_search" => 1, "select_type" => "city", "placeholder" =>             // line 112
($context["location_lang"] ?? null), "id_country" => $this->getAttribute(            // line 113
($context["data"] ?? null), "id_country", []), "id_region" => $this->getAttribute(            // line 114
($context["data"] ?? null), "id_region", []), "id_city" => $this->getAttribute(            // line 115
($context["data"] ?? null), "id_city", []), "lat" => $this->getAttribute(            // line 116
($context["data"] ?? null), "lat", []), "lon" => $this->getAttribute(            // line 117
($context["data"] ?? null), "lon", []), "radius" => $this->getAttribute(            // line 118
($context["data"] ?? null), "radius", [])]            ,            );
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
            // line 120
            echo "                                </div>
                            </div>
                        </div>
                        ";
            // line 123
            if (($context["withPhotoActive"] ?? null)) {
                // line 124
                echo "                        <div class=\"fline__item\">
                            <div class=\"f-title\">
                                ";
                // line 126
                echo twig_upper_filter($this->env,                 $this->renderBlock("__internal_75229d8aa9e6d2a526e4485397d82cf1c36cc6070a357ce5201dc5be05ddf02b", $context, $blocks));
                // line 127
                echo "                            </div>
                            <div class=\"f-block\">
                                <input type=\"checkbox\"  name=\"withPhoto\"  ";
                // line 129
                echo ((($context["withPhoto"] ?? null)) ? ("checked") : (""));
                echo ">
                            </div>
                        </div>
                        ";
            }
            // line 133
            echo "                        ";
            // line 157
            echo "
                        ";
            // line 158
            if ($this->getAttribute(($context["form_settings"] ?? null), "use_advanced", [])) {
                // line 159
                echo "                            <div class=\"fline__item more-search_block\">
                                <div class=\"f-title\">&nbsp;</div>
                                <div class=\"f-block\">
                                    <a class=\"btn btn-default hide\" style=\"display: block;\" href=\"#\" id=\"more-options-link_";
                // line 162
                echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
                echo "\" title=\"";
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
                echo "\"><i class=\"fa fa-angle-double-down icon-big text-icon\"></i><span class=\"hidden-sm hidden-md\">&nbsp;";
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
                echo "</span></a>
                                    <a class=\"btn btn-default hide\" style=\"display: block;\" href=\"#\" id=\"less-options-link_";
                // line 163
                echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
                echo "\" title=\"";
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
                echo "\"><i class=\"fa fa-angle-double-up icon-big text-icon\"></i><span class=\"hidden-sm hidden-md\">&nbsp;";
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
                echo "</span></a>
                                </div>
                            </div>
                        ";
            }
            // line 167
            echo "                        <div class=\"fline__item fline__item_right button-search_block\">
                            <div class=\"f-title\">&nbsp;</div>
                            <div class=\"f-block text-right\">
                                <input data-action=\"send_search_form\" name=\"main_search_button\" type=\"button\" id=\"main_search_button_";
            // line 170
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
                            </div>
                        </div>
                    </div>
                </div>
                <div id=\"full-search-form_";
            // line 175
            echo $this->getAttribute(($context["form_settings"] ?? null), "form_id", []);
            echo "\" class=\"advline hide\">
                    ";
            // line 176
            if ($this->getAttribute(($context["form_settings"] ?? null), "use_advanced", [])) {
                // line 177
                echo "                        <div class=\"row\">
                            ";
                // line 178
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
                    // line 179
                    echo "                                ";
                    if (($this->getAttribute($context["item"], "type", []) == "section")) {
                        // line 180
                        echo "                                    ";
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
                            // line 181
                            echo "                                        <div class=\"search-field custom ";
                            echo $this->getAttribute($this->getAttribute($context["field"], "field", []), "type", []);
                            echo " ";
                            echo $this->getAttribute($this->getAttribute($context["field"], "settings", []), "search_type", []);
                            echo "  col-xs-12 col-sm-6 col-md-3 col-lg-3\">
                                            <div class=\"f-title\">";
                            // line 182
                            echo $this->getAttribute($this->getAttribute($context["field"], "field_content", []), "name", []);
                            echo "</div>
                                            <div class=\"f-block\">
                                                ";
                            // line 184
                            $this->loadTemplate("helper_search_field_block.twig", "helper_search_form_horizontal.twig", 184)->display(twig_array_merge($context, ["field" =>                             // line 185
$context["field"], "field_name" => $this->getAttribute($this->getAttribute(                            // line 186
$context["field"], "field_content", []), "field_name", [])]));
                            // line 188
                            echo "                                            </div>
                                        </div>
                                        ";
                            // line 190
                            if ((0 == $this->getAttribute($context["loop"], "index", []) % 4)) {
                                // line 191
                                echo "                                            <div class=\"clr\"></div>
                                         ";
                            }
                            // line 193
                            echo "                                    ";
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
                        // line 194
                        echo "                                ";
                    } else {
                        // line 195
                        echo "                                    <div class=\"search-field custom ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "field", []), "type", []);
                        echo " ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "field", []), "view_type", []);
                        echo " ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "settings", []), "search_type", []);
                        echo "  col-xs-12 col-sm-6 col-md-4 col-lg-4\">
                                        <div class=\"f-title\">";
                        // line 196
                        echo $this->getAttribute($this->getAttribute($context["item"], "field_content", []), "name", []);
                        echo "</div>
                                        <div class=\"f-block\">
                                            ";
                        // line 198
                        $this->loadTemplate("helper_search_field_block.twig", "helper_search_form_horizontal.twig", 198)->display(twig_array_merge($context, ["field" =>                         // line 199
$context["item"], "field_name" => $this->getAttribute($this->getAttribute(                        // line 200
$context["item"], "field_content", []), "field_name", [])]));
                        // line 202
                        echo "                                        </div>
                                    </div>
                                    ";
                        // line 204
                        if ((0 == $this->getAttribute($context["loop"], "index", []) % 3)) {
                            // line 205
                            echo "                                        <div class=\"clr\"></div>
                                     ";
                        }
                        // line 207
                        echo "                                ";
                    }
                    // line 208
                    echo "                            ";
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
                // line 209
                echo "                            <div class=\"col-sm-12\">
                                <div class=\"bottom-serch-btn-js\"></div>
                            </div>
                        </div>
                    ";
            }
            // line 214
            echo "                </div>
            ";
        }
        // line 216
        echo "            <div class=\"clearfix\"></div>
        </div>
    </form>
</div>
<script>
    \$(function () {
        loadScripts(
                [\"";
        // line 223
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users"        ,"UsersSearch.js"        ,"path"        ,        );
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
                    users_search = new UsersSearch({
                        siteUrl: \"";
        // line 226
        echo ($context["site_url"] ?? null);
        echo "\",
                        users: {
                            countAll: ";
        // line 228
        echo $this->getAttribute(($context["page_data"] ?? null), "total_rows", []);
        echo ",
                            countPage: ";
        // line 229
        echo $this->getAttribute(($context["page_data"] ?? null), "per_page", []);
        echo "
                        },
                        page: {
                            count: ";
        // line 232
        echo $this->getAttribute(($context["page_data"] ?? null), "total_pages", []);
        echo ",
                            previous: ";
        // line 233
        echo $this->getAttribute(($context["page_data"] ?? null), "prev_page", []);
        echo ",
                            current:";
        // line 234
        echo $this->getAttribute(($context["page_data"] ?? null), "cur_page", []);
        echo ",
                            next: ";
        // line 235
        if (($this->getAttribute(($context["page_data"] ?? null), "next_page", []) == 1)) {
            echo "2";
        } else {
            echo $this->getAttribute(($context["page_data"] ?? null), "next_page", []);
        }
        // line 236
        echo "                        },
                        langs: {
                            sortBy: {
                                latestActive: '";
        // line 239
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
        echo "',
                                newest: '";
        // line 240
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
        echo "',
                                usersNotFound: '";
        // line 241
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_users_found"        ,"users"        ,        );
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
        echo ": ";
        echo $this->getAttribute(($context["page_data"] ?? null), "total_rows", []);
        echo "'
                            }
                        },
                        url: {
                            search: '";
        // line 245
        echo $this->getAttribute(($context["form_settings"] ?? null), "form_url", []);
        echo "',
                            ajaxSearch: '";
        // line 246
        echo $this->getAttribute(($context["form_settings"] ?? null), "search_url", []);
        echo "',
                            ajaxLoadUsers: '";
        // line 247
        echo $this->getAttribute(($context["form_settings"] ?? null), "load_users", []);
        echo "'
                        }
                    });
                },
                ['users_search']
                );
    });
</script>
";
    }

    // line 66
    public function block___internal_a5cb22fe69987f90c049f880545268b4be1e2e8d6d867220062eeefc439550d7($context, array $blocks = [])
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

    // line 80
    public function block___internal_c366d7e4542c1496a3c309814367b128b7bd8a01d1e8931c7fb7bcb0d53d2aeb($context, array $blocks = [])
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

    // line 104
    public function block___internal_fea2b96cba22ca1f85c48797374a255202bbc71d0b0caa0dbaa3c7a892761af1($context, array $blocks = [])
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

    // line 126
    public function block___internal_75229d8aa9e6d2a526e4485397d82cf1c36cc6070a357ce5201dc5be05ddf02b($context, array $blocks = [])
    {
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_with_photo"        ,"users"        ,        );
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
        return "helper_search_form_horizontal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1001 => 126,  976 => 104,  951 => 80,  926 => 66,  913 => 247,  909 => 246,  905 => 245,  877 => 241,  854 => 240,  831 => 239,  826 => 236,  820 => 235,  816 => 234,  812 => 233,  808 => 232,  802 => 229,  798 => 228,  793 => 226,  768 => 223,  759 => 216,  755 => 214,  748 => 209,  734 => 208,  731 => 207,  727 => 205,  725 => 204,  721 => 202,  719 => 200,  718 => 199,  717 => 198,  712 => 196,  703 => 195,  700 => 194,  686 => 193,  682 => 191,  680 => 190,  676 => 188,  674 => 186,  673 => 185,  672 => 184,  667 => 182,  660 => 181,  642 => 180,  639 => 179,  622 => 178,  619 => 177,  617 => 176,  613 => 175,  584 => 170,  579 => 167,  530 => 163,  484 => 162,  479 => 159,  477 => 158,  474 => 157,  472 => 133,  465 => 129,  461 => 127,  459 => 126,  455 => 124,  453 => 123,  448 => 120,  430 => 118,  429 => 117,  428 => 116,  427 => 115,  426 => 114,  425 => 113,  424 => 112,  420 => 108,  415 => 105,  413 => 104,  406 => 99,  388 => 97,  387 => 96,  383 => 93,  378 => 90,  360 => 88,  359 => 87,  355 => 84,  350 => 81,  348 => 80,  342 => 76,  324 => 74,  323 => 73,  322 => 72,  318 => 69,  314 => 67,  312 => 66,  306 => 62,  274 => 54,  270 => 52,  252 => 50,  251 => 49,  250 => 48,  249 => 47,  245 => 45,  240 => 42,  222 => 40,  221 => 39,  217 => 36,  212 => 33,  194 => 31,  193 => 30,  189 => 27,  165 => 25,  155 => 18,  152 => 17,  150 => 16,  144 => 13,  121 => 12,  117 => 11,  114 => 10,  112 => 9,  108 => 8,  101 => 6,  97 => 4,  76 => 3,  55 => 2,  34 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_search_form_horizontal.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_search_form_horizontal.twig");
    }
}
