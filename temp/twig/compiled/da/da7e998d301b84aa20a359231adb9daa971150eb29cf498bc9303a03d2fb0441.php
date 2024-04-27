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

/* index.twig */
class __TwigTemplate_6bd58a8e823b72907dac1b93d4f2dab65177543b68cd31e5b27adf491bfab700 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "index.twig", 1)->display($context);
        // line 2
        echo "<div class=\"container-fluid\">
    <div class=\"row row-content\">
        <div id=\"access_permissions\">
            <div data-content=\"advertising-image\" class=\"hide\">
                <div class=\"advertising-image\">
                    <div class=\"tagline\">";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_slogan"        ,"access_permissions"        ,        );
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
                    <div class=\"btn-actions\">
                        <a href=\"";
        // line 9
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("access_permissions"        ,"index"        ,        );
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
        echo "\" class=\"btn btn-default\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_groups"        ,"access_permissions"        ,        );
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
                        <a href=\"";
        // line 10
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"account"        ,"services"        ,        );
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
        echo "\" class=\"services\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_services"        ,"access_permissions"        ,        );
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
                ";
        // line 13
        $module =         null;
        $helper =         'access_permissions';
        $name =         'isModule';
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
        // line 14
        echo "            </div>
            <div>
                <div class=\"access-list\">
                ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["group"]) {
            // line 18
            echo "                    ";
            if ((((($this->getAttribute($context["group"], "is_default", []) != 1) &&  !twig_test_empty($this->getAttribute($context["group"], "periods", []))) || $this->getAttribute($context["group"], "is_default", [])) || $this->getAttribute($context["group"], "is_trial", []))) {
                // line 19
                echo "                        <div class=\"item-group\">
                            <div class=\"g-flatty-block group-block active well\" id=\"";
                // line 20
                echo $this->getAttribute($context["group"], "gid", []);
                echo "-block\">
                                <div class=\"title-block center\">";
                // line 21
                echo $this->getAttribute($context["group"], "current_name", []);
                echo "</div>
                                <div class=\"center periods\">
                                    ";
                // line 23
                if ($this->getAttribute($context["group"], "is_default", [])) {
                    // line 24
                    echo "                                        <div class=\"period-block\">
                                            <div class=\"price\">
                                                ";
                    // line 26
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'currency_format_output';
                    $params = array(["value" => 0]                    ,                    );
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
                    echo "                                            </div>
                                            <div>";
                    // line 28
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_period_unlimited"                    ,"access_permissions"                    ,                    );
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
                                        </div>
                                    ";
                } elseif ($this->getAttribute(                // line 30
$context["group"], "is_trial", [])) {
                    // line 31
                    echo "                                        <div class=\"period-block\">
                                            <div class=\"price\">
                                                ";
                    // line 33
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'currency_format_output';
                    $params = array(["value" => 0]                    ,                    );
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
                    echo "                                            </div>
                                            ";
                    // line 36
                    echo "                                            <div>";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_expires_in"                    ,"access_permissions"                    ,                    );
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
                    echo ":&nbsp; ";
                    echo $this->getAttribute($this->getAttribute($context["group"], "trial_period_left", []), "str", []);
                    echo "</div>
                                        </div>
                                    ";
                } else {
                    // line 39
                    echo "                                        <div id=\"period-";
                    echo $this->getAttribute($context["group"], "gid", []);
                    echo "\" class=\"period-block\" data-group=\"";
                    echo $this->getAttribute($context["group"], "gid", []);
                    echo "\" data-id=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["group"], "periods", []), 0, []), "id", []);
                    echo "\" data-period=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["group"], "periods", []), 0, []), "period", []);
                    echo "\" data-price=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["group"], "periods", []), 0, []), "price", []);
                    echo "\">
                                            <div class=\"price\">
                                                ";
                    // line 41
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'currency_format_output';
                    $params = array(["value" => $this->getAttribute($this->getAttribute($this->getAttribute(($context["group"] ?? null), "periods", []), 0, []), "price", [])]                    ,                    );
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
                    echo "                                            </div>
                                            <span class=\"period\">";
                    // line 43
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["group"], "periods", []), 0, []), "period_str", []);
                    echo "</span><i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i>
                                        </div>
                                        <div id=\"period-";
                    // line 45
                    echo $this->getAttribute($context["group"], "gid", []);
                    echo "-all\" class=\"hide all-periods\">
                                            <div class=\"box-sizing\">
                                                ";
                    // line 47
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["group"], "periods", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["period"]) {
                        // line 48
                        echo "                                                    <div id=\"period-";
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "-";
                        echo $this->getAttribute($context["period"], "id", []);
                        echo "\" class=\"all-period\" data-group=\"";
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\" data-id=\"";
                        echo $this->getAttribute($context["period"], "id", []);
                        echo "\" data-period=\"";
                        echo $this->getAttribute($context["period"], "period", []);
                        echo "\" data-price=\"";
                        echo $this->getAttribute($context["period"], "price", []);
                        echo "\">
                                                        <span>";
                        // line 49
                        echo $this->getAttribute($context["period"], "period_str", []);
                        echo "</span>
                                                    </div>
                                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['period'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 52
                    echo "                                            </div>
                                        </div>
                                    ";
                }
                // line 55
                echo "                                </div>
                                <div>
                                    ";
                // line 57
                if (($this->getAttribute($context["group"], "is_default", []) || $this->getAttribute($context["group"], "is_trial", []))) {
                    // line 58
                    echo "                                        <input class=\"btn btn-active btn-group-justified\" type=\"button\" value=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_active"                    ,"access_permissions"                    ,                    );
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
                } else {
                    // line 60
                    echo "                                        <div class=\"actions-block actions-block-absolute\">
                                            <div class=\"btn-group\">
                                                    ";
                    // line 62
                    if ($this->getAttribute($context["group"], "is_purchased", [])) {
                        // line 63
                        echo "                                                        <a class=\"btn btn-group-justified buy\" href=\"";
                        $module =                         null;
                        $helper =                         'seo';
                        $name =                         'seolink';
                        $params = array("access_permissions/groupPage"                        ,$this->getAttribute(($context["group"] ?? null), "gid", [])                        ,$this->getAttribute($this->getAttribute($this->getAttribute(($context["group"] ?? null), "periods", []), 0, []), "id", [])                        ,                        );
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
                        echo "\" data-action=\"select-group\" data-group=\"";
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\" name=\"buy\">
                                                            ";
                        // line 64
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_active"                        ,"access_permissions"                        ,                        );
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
                        // line 65
                        echo "                                                        </a>
                                                        <button type=\"button\" class=\"btn btn-group-justified dropdown-toggle sel set-data-js\" data-toggle=\"dropdown\" data-action=\"pay-systems\" data-group=\"";
                        // line 66
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\" id=\"pay-item-";
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\">
                                                            <span class=\"caret\"></span>
                                                            <span class=\"sr-only\">Dropdown toggle</span>
                                                       </button>
                                                    ";
                    } else {
                        // line 71
                        echo "                                                        <a type=\"button\" class=\"btn btn-primary buy\" href=\"";
                        $module =                         null;
                        $helper =                         'seo';
                        $name =                         'seolink';
                        $params = array("access_permissions/groupPage"                        ,$this->getAttribute(($context["group"] ?? null), "gid", [])                        ,$this->getAttribute($this->getAttribute($this->getAttribute(($context["group"] ?? null), "periods", []), 0, []), "id", [])                        ,                        );
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
                        echo "\" data-action=\"select-group\" data-group=\"";
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\" name=\"buy\">
                                                            ";
                        // line 72
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_buy_now"                        ,"services"                        ,                        );
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
                        // line 73
                        echo "                                                        </a>
                                                        <button type=\"button\" class=\"btn btn-primary dropdown-toggle sel set-data-js\" data-toggle=\"dropdown\" data-action=\"pay-systems\" data-group=\"";
                        // line 74
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\" id=\"pay-item-";
                        echo $this->getAttribute($context["group"], "gid", []);
                        echo "\">
                                                            <span class=\"caret\"></span>
                                                            <span class=\"sr-only\">Dropdown toggle</span>
                                                       </button>
                                                    ";
                    }
                    // line 79
                    echo "                                                    <ul id=\"pay-systems-list-";
                    echo $this->getAttribute($context["group"], "gid", []);
                    echo "\" class=\"dropdown-menu \" role=\"menu\">
                                                        <li>
                                                            <a data-target=\"#\" class=\"cursor-pointer\" data-action=\"set-paysystem\" data-gid=\"account\">
                                                              ";
                    // line 82
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_pay_account"                    ,"services"                    ,                    );
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
                    // line 83
                    echo "                                                            </a>
                                                        </li>
                                                        ";
                    // line 85
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["system"]) {
                        // line 86
                        echo "                                                            <li>
                                                                <a class=\"cursor-pointer\" data-action=\"set-paysystem\"  data-gid=\"";
                        // line 87
                        echo $this->getAttribute($context["system"], "gid", []);
                        echo "\">
                                                                    <img src=\"";
                        // line 88
                        echo $this->getAttribute($context["system"], "logo_url", []);
                        echo "\">
                                                                    ";
                        // line 89
                        echo $this->getAttribute($context["system"], "name", []);
                        echo "
                                                                </a>
                                                            </li>
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['system'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 93
                    echo "                                                    </ul>
                                            </div>
                                        </div>
                                        <div class=\"clearfix\"></div>
                                    ";
                }
                // line 98
                echo "                                </div>
                                <div class=\"modules ";
                // line 99
                if ($this->getAttribute($context["group"], "is_default", [])) {
                    echo "default-group";
                }
                echo "\">
                                    ";
                // line 100
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["group"], "access", []));
                foreach ($context['_seq'] as $context["module_gid"] => $context["module"]) {
                    // line 101
                    echo "                                        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($context["module"]);
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 102
                        echo "                                            ";
                        if ($this->getAttribute($context["item"], "is_available", [])) {
                            // line 103
                            echo "                                                <div class=\"module\">
                                                    <div class=\"module-name\">";
                            // line 104
                            echo $this->getAttribute($context["item"], "name", []);
                            echo "</div>
                                                    <div class=\"module-description\">
                                                        ";
                            // line 106
                            echo $this->getAttribute($context["item"], "description", []);
                            echo "
                                                        ";
                            // line 107
                            $module =                             null;
                            $helper =                             'access_permissions';
                            $name =                             'isCount';
                            $params = array(["data" => ["module_gid" => ($context["module_gid"] ?? null)], "permissions" => $this->getAttribute(($context["item"] ?? null), "list", []), "group_gid" => ($context["key"] ?? null)]                            ,                            );
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
                            $context['count'] = $result;
                            // line 108
                            echo "                                                        ";
                            if (($context["count"] ?? null)) {
                                // line 109
                                echo "                                                            ";
                                $context['_parent'] = $context;
                                $context['_seq'] = twig_ensure_traversable(($context["count"] ?? null));
                                foreach ($context['_seq'] as $context["type"] => $context["value"]) {
                                    // line 110
                                    echo "                                                                <div>";
                                    echo $this->getAttribute($context["value"], "name", []);
                                    echo ":
                                                                    ";
                                    // line 111
                                    if (($this->getAttribute($context["value"], "count", []) > 0)) {
                                        // line 112
                                        echo "                                                                        ";
                                        echo $this->getAttribute($context["value"], "count", []);
                                        echo "
                                                                    ";
                                    } else {
                                        // line 114
                                        echo "                                                                         ";
                                        $module =                                         null;
                                        $helper =                                         'lang';
                                        $name =                                         'l';
                                        $params = array("field_period_unlimited"                                        ,"access_permissions"                                        ,                                        );
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
                                        echo "                                                                     ";
                                    }
                                    // line 116
                                    echo "                                                                </div>
                                                            ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['type'], $context['value'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 118
                                echo "                                                        ";
                            }
                            // line 119
                            echo "                                                    </div>
                                                </div>
                                            ";
                        }
                        // line 122
                        echo "                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 123
                    echo "                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['module_gid'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 124
                echo "                                    <div class=\"toggle-block center\" data-action=\"groupToggle\" data-group=\"";
                echo $this->getAttribute($context["group"], "gid", []);
                echo "\">
                                        <i class=\"fa\"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
            }
            // line 131
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        echo "                </div>
            </div>
        </div>
    </div>
</div>
";
        // line 137
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
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
        $context['currency'] = $result;
        // line 138
        $module =         null;
        $helper =         'access_permissions';
        $name =         'jsData';
        $params = array(["headerAdvertisingImage" => 1, "currency" => ($context["currency"] ?? null)]        ,        );
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
        // line 139
        $this->loadTemplate("@app/footer.twig", "index.twig", 139)->display($context);
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  805 => 139,  784 => 138,  763 => 137,  756 => 132,  750 => 131,  739 => 124,  733 => 123,  727 => 122,  722 => 119,  719 => 118,  712 => 116,  709 => 115,  687 => 114,  681 => 112,  679 => 111,  674 => 110,  669 => 109,  666 => 108,  645 => 107,  641 => 106,  636 => 104,  633 => 103,  630 => 102,  625 => 101,  621 => 100,  615 => 99,  612 => 98,  605 => 93,  595 => 89,  591 => 88,  587 => 87,  584 => 86,  580 => 85,  576 => 83,  555 => 82,  548 => 79,  538 => 74,  535 => 73,  514 => 72,  488 => 71,  478 => 66,  475 => 65,  454 => 64,  428 => 63,  426 => 62,  422 => 60,  397 => 58,  395 => 57,  391 => 55,  386 => 52,  377 => 49,  362 => 48,  358 => 47,  353 => 45,  348 => 43,  345 => 42,  324 => 41,  310 => 39,  282 => 36,  279 => 34,  258 => 33,  254 => 31,  252 => 30,  228 => 28,  225 => 27,  204 => 26,  200 => 24,  198 => 23,  193 => 21,  189 => 20,  186 => 19,  183 => 18,  179 => 17,  174 => 14,  153 => 13,  107 => 10,  63 => 9,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\access_permissions\\views\\flatty\\index.twig");
    }
}
