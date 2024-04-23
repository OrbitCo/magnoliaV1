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

/* custom/helper_users_registration.twig */
class __TwigTemplate_913ae8df4a7ebd11008576bae4136d107026e1714a356b8fa3ed67fa66e0d7ec extends \Twig\Template
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
        echo "<div class=\"registration-block\">
  ";
        // line 2
        if (($this->getAttribute(($context["data"] ?? null), "is_link", []) == 1)) {
            // line 3
            echo "    <div class=\"continue-block\">
      <button data-action=\"show-registration-block\" ";
            // line 4
            if (($this->getAttribute(($context["data"] ?? null), "gotoform", []) == 1)) {
                echo "data-gotoform=\"1\"";
            }
            // line 5
            echo "              class=\"btn btn-primary btn-lg btn-block btn-regshow";
            if ($this->getAttribute(($context["data"] ?? null), "class", [])) {
                echo " ";
                echo $this->getAttribute(($context["data"] ?? null), "class", []);
            }
            echo "\">";
            echo $this->getAttribute(($context["data"] ?? null), "reglang", []);
            echo "</button>
    </div>
  ";
        }
        // line 8
        echo "  ";
        if (($this->getAttribute(($context["data"] ?? null), "is_load_form", []) == 0)) {
            // line 9
            echo "    <form method=\"post\" enctype=\"multipart/form-data\" action=\"";
            echo $this->getAttribute(($context["data"] ?? null), "form_action", []);
            echo "\" autocomplete=\"off\">
      ";
            // line 10
            if (($this->getAttribute(($context["data"] ?? null), "is_auth", []) == 0)) {
                // line 11
                echo "        ";
                if ((($this->getAttribute(($context["data"] ?? null), "is_link", []) == 0) && ($this->getAttribute(($context["data"] ?? null), "is_registration", []) == 0))) {
                    // line 12
                    echo "          ";
                    $this->loadTemplate("registration/first_page.twig", "custom/helper_users_registration.twig", 12)->display(twig_array_merge($context, ["is_link" => 0]));
                    // line 13
                    echo "        ";
                }
                // line 14
                echo "      ";
            }
            // line 15
            echo "      <div class=\"main-block-pages hide\">
        <div class=\"pages-wraper\">
          ";
            // line 17
            if (($this->getAttribute(($context["data"] ?? null), "is_auth", []) == 0)) {
                // line 18
                echo "            ";
                if ((($this->getAttribute(($context["data"] ?? null), "is_link", []) == 1) || ($this->getAttribute(($context["data"] ?? null), "is_registration", []) == 1))) {
                    // line 19
                    echo "              ";
                    $this->loadTemplate("registration/first_page.twig", "custom/helper_users_registration.twig", 19)->display(twig_array_merge($context, ["is_link" => 1]));
                    // line 20
                    echo "            ";
                }
                // line 21
                echo "            ";
                $this->loadTemplate("registration/second_page.twig", "custom/helper_users_registration.twig", 21)->display($context);
                // line 22
                echo "            ";
                $module =                 null;
                $helper =                 'users';
                $name =                 'registrationThirdPage';
                $params = array(["user_data" => ($context["user_data"] ?? null), "data" => ($context["data"] ?? null)]                ,                );
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
                // line 23
                echo "          ";
            }
            // line 24
            echo "          ";
            $this->loadTemplate("registration/fourth_page.twig", "custom/helper_users_registration.twig", 24)->display($context);
            // line 25
            echo "        </div>
      </div>
    </form>
  ";
        }
        // line 29
        echo "</div>
";
        // line 30
        if (($this->getAttribute(($context["data"] ?? null), "is_load_form", []) == 0)) {
            // line 31
            echo "  ";
            $module =             null;
            $helper =             'incomplete_signup';
            $name =             'incomplete_signup_script';
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
            // line 32
            echo "  <script>
    \$(function () {
      new UsersRegistration({
        siteUrl: site_url,
        pageBlock:";
            // line 36
            echo $this->getAttribute(($context["data"] ?? null), "page", []);
            echo ",
        isAuth:";
            // line 37
            echo $this->getAttribute(($context["data"] ?? null), "is_auth", []);
            echo ",
        isLink:";
            // line 38
            echo $this->getAttribute(($context["data"] ?? null), "is_link", []);
            echo ",
        isRegistration: ";
            // line 39
            if (($context["is_registration"] ?? null)) {
                echo "1";
            } else {
                echo "0";
            }
            echo ",
        langs: {
          defaultDay: '";
            // line 41
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("date_format_day"            ,"start"            ,""            ,"js"            ,            );
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
          defaultMonth: '";
            // line 42
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("date_format_month"            ,"start"            ,""            ,"js"            ,            );
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
          defaultYear: '";
            // line 43
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("date_format_year"            ,"start"            ,""            ,"js"            ,            );
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
            // line 46
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "age", []), "min", []);
            echo "',
          age_max: '";
            // line 47
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "age", []), "max", []);
            echo "',
          birth_date: '";
            // line 48
            echo $this->getAttribute(($context["user_data"] ?? null), "birth_date_raw", []);
            echo "',
          dateFormat: '";
            // line 49
            echo $this->getAttribute(($context["date_format_ui"] ?? null), "date_literal", []);
            echo "',
          isAuth: '";
            // line 50
            echo $this->getAttribute(($context["data"] ?? null), "is_auth", []);
            echo "',
          setDate: ";
            // line 51
            if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "birth_date", []))) {
                echo "'";
                echo $this->getAttribute(($context["user_data"] ?? null), "birth_date", []);
                echo "'
          ";
            } else {
                // line 52
                echo "'";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "min_date", []));
                echo "'";
            }
            // line 53
            echo "        },
        errors: ";
            // line 54
            echo twig_jsonencode_filter(($context["errors_data"] ?? null));
            echo ",
        usersFieldsValidation: new UsersFieldsValidation({
          siteUrl: site_url,
          objBtnDisabled: '[data-page=\"3\"]',
          ages: {
            age_min: '";
            // line 59
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "age", []), "min", []);
            echo "',
            age_max: '";
            // line 60
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "age", []), "max", []);
            echo "'
          },
          fields: {
      ";
            // line 63
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "rules", []));
            foreach ($context['_seq'] as $context["field"] => $context["rule"]) {
                // line 64
                echo "      ";
                echo $context["field"];
                echo ":
      false,
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['field'], $context['rule'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "        confirmation
    :
      false
    },
      langs: {
        errors: {
          ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "rules", []));
            foreach ($context['_seq'] as $context["field"] => $context["rule"]) {
                // line 74
                echo "          ";
                echo $context["field"];
                echo ":
          \"";
                // line 75
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array((("error_" . ($context["field"] ?? null)) . "_incorrect")                ,"users"                ,""                ,"js"                ,                );
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
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['field'], $context['rule'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            echo "            confirmation
        :
          \"";
            // line 79
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_no_confirmation"            ,"users"            ,""            ,"js"            ,            );
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
        }
      ,
      }
    ,
      rules: {
        ";
            // line 85
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "rules", []));
            foreach ($context['_seq'] as $context["field"] => $context["rule"]) {
                // line 86
                echo "        ";
                echo $context["field"];
                echo ":";
                echo $context["rule"];
                echo ",
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['field'], $context['rule'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 88
            echo "        confirmation: /[1]{1,1}\$/
      }
    })
    })

    })
  </script>
  ";
            // line 95
            if (($this->getAttribute(($context["data"] ?? null), "is_auth", []) != 0)) {
                // line 96
                echo "    <script>
      \$(function () {

        function UsersAvatarRegistration() {
          user_avatar = new UsersAvatar({
            site_url: site_url,
            id_user:";
                // line 102
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "id", []);
                echo ",
            saveAfterSelect: false,
            haveAvatar: '";
                // line 104
                echo $this->getAttribute(($context["data"] ?? null), "have_avatar", []);
                echo "',
            mobileWidth: 0,
            callback: function () {
              \$('#user_photo>div').hide();
            }
          });
        }
        UsersAvatarRegistration();
      })
    </script>
  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "custom/helper_users_registration.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  435 => 104,  430 => 102,  422 => 96,  420 => 95,  411 => 88,  400 => 86,  396 => 85,  368 => 79,  364 => 77,  337 => 75,  332 => 74,  328 => 73,  320 => 67,  310 => 64,  306 => 63,  300 => 60,  296 => 59,  288 => 54,  285 => 53,  280 => 52,  273 => 51,  269 => 50,  265 => 49,  261 => 48,  257 => 47,  253 => 46,  228 => 43,  205 => 42,  182 => 41,  173 => 39,  169 => 38,  165 => 37,  161 => 36,  155 => 32,  133 => 31,  131 => 30,  128 => 29,  122 => 25,  119 => 24,  116 => 23,  94 => 22,  91 => 21,  88 => 20,  85 => 19,  82 => 18,  80 => 17,  76 => 15,  73 => 14,  70 => 13,  67 => 12,  64 => 11,  62 => 10,  57 => 9,  54 => 8,  42 => 5,  38 => 4,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom/helper_users_registration.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/custom/helper_users_registration.twig");
    }
}
