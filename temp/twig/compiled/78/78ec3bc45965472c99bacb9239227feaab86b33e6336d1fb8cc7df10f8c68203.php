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

/* helper_actions_settings.twig */
class __TwigTemplate_639af3bbda29f2895c01fb0770d75afe2d7f2428e7cc9453e25d93454abe4cbe extends \Twig\Template
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
        $module =         null;
        $helper =         'services';
        $name =         'servicesBuyList';
        $params = array(["tpl" => "magazine"]        ,        );
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
        // line 2
        if ($this->getAttribute(($context["services_data"] ?? null), "is_access_permissions", [])) {
            // line 3
            echo "    ";
            ob_start(function () { return ''; });
            $module =             null;
            $helper =             'access_permissions';
            $name =             'isMoreThanOneActiveGroup';
            $params = array(            );
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
            $context["is_one_group"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 4
            echo "    ";
            $module =             null;
            $helper =             'access_permissions';
            $name =             'getUserGroupInfo';
            $params = array(["id_user" => $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []), "is_default_excluded" => 1]            ,            );
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
            $context['user_group'] = $result;
            // line 5
            echo "    ";
            if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                // line 6
                echo "        <div class=\"clearfix\"></div>
        <div class=\"membership-block\">
            <div class=\"center\">
                <div class=\"user-description mt10\">";
                // line 9
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_your_group"                ,"access_permissions"                ,                );
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
                echo ":</div>
                <div class=\"user-description\">[
                    ";
                // line 11
                if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                    // line 12
                    echo "                        <a href=\"";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("access_permissions"                    ,"index"                    ,                    );
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
                    echo "\" class=\"membership-link\">
                    ";
                } else {
                    // line 13
                    echo "                        
                        <span class=\"membership-title\">
                    ";
                }
                // line 15
                echo "                        
                    ";
                // line 16
                echo $this->getAttribute($this->getAttribute(($context["user_group"] ?? null), "data", []), "current_name", []);
                echo "
                    ";
                // line 17
                if ((twig_length_filter($this->env, ($context["is_one_group"] ?? null)) > 0)) {
                    echo "                    
                        </a>                       
                    ";
                } else {
                    // line 20
                    echo "                        </span>
                    ";
                }
                // line 22
                echo "                    ]</div>
            </div>
            ";
                // line 24
                if ($this->getAttribute(($context["user_group"] ?? null), "left_str", [])) {
                    // line 25
                    echo "            <div class=\"center\">
                <span class=\"user-description\">";
                    // line 26
                    echo $this->getAttribute(($context["user_group"] ?? null), "left_str", []);
                    echo " ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("date_diff_left"                    ,"services"                    ,                    );
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
            ";
                }
                // line 29
                echo "        </div>
        <div class=\"center\">
            <a class=\"btn btn-outline-primary\" href=\"";
                // line 31
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("access_permissions"                ,"index"                ,                );
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
            ";
                // line 32
                if ((twig_length_filter($this->env, $this->getAttribute(($context["user_group"] ?? null), "left_str", [])) > 0)) {
                    // line 33
                    echo "                    onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("left_menu_user"                    ,"prolong"                    ,                    );
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
            ";
                } else {
                    // line 35
                    echo "                    onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("left_menu_user"                    ,"upgrade"                    ,                    );
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
            ";
                }
                // line 37
                echo "            >
                <i class=\"fa fa-rocket\"></i>
                ";
                // line 39
                if ((twig_length_filter($this->env, $this->getAttribute(($context["user_group"] ?? null), "left_str", [])) > 0)) {
                    // line 40
                    echo "                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_prolong_membership"                    ,"access_permissions"                    ,                    );
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
                    // line 41
                    echo "                ";
                } else {
                    // line 42
                    echo "                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_get_premium"                    ,"users"                    ,                    );
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
                    echo "                ";
                }
                // line 44
                echo "            </a>
        </div>
    ";
            }
        }
        // line 48
        echo "<div class=\"clearfix\"></div>";
    }

    public function getTemplateName()
    {
        return "helper_actions_settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  357 => 48,  351 => 44,  348 => 43,  326 => 42,  323 => 41,  301 => 40,  299 => 39,  295 => 37,  270 => 35,  245 => 33,  243 => 32,  220 => 31,  216 => 29,  189 => 26,  186 => 25,  184 => 24,  180 => 22,  176 => 20,  170 => 17,  166 => 16,  163 => 15,  158 => 13,  133 => 12,  131 => 11,  107 => 9,  102 => 6,  99 => 5,  77 => 4,  53 => 3,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_actions_settings.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_actions_settings.twig");
    }
}
