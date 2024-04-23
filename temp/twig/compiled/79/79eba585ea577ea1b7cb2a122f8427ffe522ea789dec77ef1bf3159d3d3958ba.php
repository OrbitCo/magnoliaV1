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

/* view_my_profile.twig */
class __TwigTemplate_c46e582e0163ccc0107d31782eb04ecc384b18edac5858d7f23185acf103b4b6 extends \Twig\Template
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
        echo "<h2 class=\"section-header\">
    <span class=\"upper\">
        ";
        // line 3
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
        // line 4
        echo "        ";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_section_personal"        ,"users"        ,        );
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
        $context['personal_section_name'] = $result;
        // line 5
        echo "    </span>
    <a href=\"";
        // line 6
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"profile"        ,["section-code" => "personal", "section-name" => ($context["personal_section_name"] ?? null)]        ,        );
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
        echo "\" class=\"fright\">
        <i class=\"fas fa-pencil-alt\"></i>&nbsp;Edit
    </a>
</h2>

<div class=\"view-section owner-actions\">
    ";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_information"        ,"users"        ,        );
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
        $context['no_info_str'] = $result;
        // line 13
        echo "
    <div class=\"field-block clearfix\">
        <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
            ";
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_user_type"        ,"users"        ,        );
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
        </div>
        <div class=\"field-info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
            ";
        // line 19
        echo $this->getAttribute(($context["data"] ?? null), "user_type_str", []);
        echo "
        </div>
    </div>

    ";
        // line 23
        if ($this->getAttribute(($context["data"] ?? null), "looking_user_type_str", [])) {
            // line 24
            echo "        <div class=\"field-block clearfix\" data-field=\"looking_user_type\" data-action=\"change-field\">
            <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
                ";
            // line 26
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_looking_user_type"            ,"users"            ,            );
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
            </div>
            <div class=\"field-info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
                ";
            // line 29
            echo $this->getAttribute(($context["data"] ?? null), "looking_user_type_str", []);
            echo ", ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_aged"            ,"users"            ,            );
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
            // line 30
            echo "                ";
            if ($this->getAttribute(($context["data"] ?? null), "age_min", [])) {
                echo $this->getAttribute(($context["data"] ?? null), "age_min", []);
            }
            // line 31
            echo "                ";
            if (($this->getAttribute(($context["data"] ?? null), "age_min", []) && $this->getAttribute(($context["data"] ?? null), "age_max", []))) {
                echo " - ";
            }
            // line 32
            echo "                ";
            if ($this->getAttribute(($context["data"] ?? null), "age_max", [])) {
                echo $this->getAttribute(($context["data"] ?? null), "age_max", []);
            }
            // line 33
            echo "                <i class=\"fas fa-pencil-alt\"></i>
            </div>
        </div>
    ";
        }
        // line 37
        echo "
    <div class=\"field-block clearfix\" data-field=\"nickname\" data-action=\"change-field\">
        <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
            ";
        // line 40
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_nickname"        ,"users"        ,        );
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
        </div>
        <div class=\"field-info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
            ";
        // line 43
        echo $this->getAttribute(($context["data"] ?? null), "nickname", []);
        echo "<i class=\"fas fa-pencil-alt\"></i>
        </div>
    </div>
    <div class=\"field-block clearfix\" data-field=\"fname_sname\" data-action=\"change-field\">
        <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
            ";
        // line 48
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_name"        ,"users"        ,        );
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
        </div>
        <div class=\"field-info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
            ";
        // line 51
        echo $this->getAttribute(($context["data"] ?? null), "fname", []);
        echo " ";
        if ($this->getAttribute(($context["data"] ?? null), "sname", [])) {
            echo $this->getAttribute(($context["data"] ?? null), "sname", []);
        }
        // line 52
        echo "            <i class=\"fas fa-pencil-alt\"></i>
        </div>
    </div>
    <div class=\"field-block clearfix\"  ";
        // line 55
        if ( !$this->getAttribute(($context["not_editable_fields"] ?? null), "birth_date", [])) {
            echo "data-field=\"birth_date\" data-action=\"change-field\"";
        }
        echo ">
        <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
            ";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("birth_date"        ,"users"        ,        );
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
        </div>
        <div class=\"field-info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
            ";
        // line 60
        if ($this->getAttribute(($context["data"] ?? null), "birth_date", [])) {
            // line 61
            echo "                ";
            echo $this->getAttribute(($context["data"] ?? null), "birth_date", []);
            echo "
            ";
        } else {
            // line 63
            echo "                ";
            echo ($context["no_info_str"] ?? null);
            echo "
            ";
        }
        // line 65
        echo "            ";
        if ( !$this->getAttribute(($context["not_editable_fields"] ?? null), "birth_date", [])) {
            echo "<i class=\"fas fa-pencil-alt\"></i>";
        }
        // line 66
        echo "        </div>
    </div>

    ";
        // line 69
        if ($this->getAttribute(($context["data"] ?? null), "location", [])) {
            // line 70
            echo "        <div class=\"field-block clearfix\" data-field=\"location\" data-action=\"change-field\">
            <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
                ";
            // line 72
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_region"            ,"users"            ,            );
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
            </div>
            <div class=\"field-info col-xs-8 col-sm-8 col-md-8 col-lg-8\">
                ";
            // line 75
            echo $this->getAttribute(($context["data"] ?? null), "location", []);
            echo "<i class=\"fas fa-pencil-alt\"></i>
            </div>
        </div>
    ";
        }
        // line 79
        echo "</div>

";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
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
            // line 82
            echo "    <h2 class=\"section-header\">
        <span class=\"upper\">
            ";
            // line 84
            echo $this->getAttribute($context["item"], "name", []);
            echo "
        </span>
        <a href=\"";
            // line 86
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"profile"            ,["section-code" => $this->getAttribute(($context["item"] ?? null), "gid", []), "section-name" => $this->getAttribute(($context["item"] ?? null), "name", [])]            ,            );
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
            echo "\" class=\"fright\">
            <i class=\"fas fa-pencil-alt\"></i>&nbsp;Edit
        </a>
    </h2>
    <div class=\"view-section owner-actions\">
        ";
            // line 91
            $this->loadTemplate("custom_view_fields.twig", "view_my_profile.twig", 91)->display(twig_array_merge($context, ["fields_data" => $this->getAttribute($context["item"], "fields", []), "is_owner" => ($context["is_owner"] ?? null)]));
            // line 92
            echo "    </div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"datepicker-select-template.js"        ,        );
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
        echo "<script type=\"text/javascript\">
    \$(function () {
        loadScripts(
                \"";
        // line 98
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users"        ,"users-settings.js"        ,"path"        ,        );
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
                    users_settings_obj = new usersSettings({
                        siteUrl: site_url,
                        langs: {
                            save: \"";
        // line 103
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"js"        ,        );
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
                            link_select_region: '";
        // line 104
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_select_region"        ,"countries"        ,        );
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
        echo "'
                        },
                        user: {
                            age_min: '";
        // line 107
        echo ($context["age_min"] ?? null);
        echo "',
                            age_max: '";
        // line 108
        echo ($context["age_max"] ?? null);
        echo "',
                            birth_date: '";
        // line 109
        echo $this->getAttribute(($context["data"] ?? null), "birth_date_raw", []);
        echo "',
                            dateFormat: '";
        // line 110
        echo $this->getAttribute(($context["date_format_ui"] ?? null), "date_literal", []);
        echo "'
                        },
                         usersProfileAvailableView: new available_view({
                            siteUrl: site_url
                        })
                    });
                },
                'users_settings_obj',
                {async: false}
        );
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "view_my_profile.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  596 => 110,  592 => 109,  588 => 108,  584 => 107,  559 => 104,  536 => 103,  509 => 98,  504 => 95,  483 => 94,  468 => 92,  466 => 91,  439 => 86,  434 => 84,  430 => 82,  413 => 81,  409 => 79,  402 => 75,  377 => 72,  373 => 70,  371 => 69,  366 => 66,  361 => 65,  355 => 63,  349 => 61,  347 => 60,  322 => 57,  315 => 55,  310 => 52,  304 => 51,  279 => 48,  271 => 43,  246 => 40,  241 => 37,  235 => 33,  230 => 32,  225 => 31,  220 => 30,  197 => 29,  172 => 26,  168 => 24,  166 => 23,  159 => 19,  134 => 16,  129 => 13,  108 => 12,  80 => 6,  77 => 5,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view_my_profile.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\view_my_profile.twig");
    }
}
