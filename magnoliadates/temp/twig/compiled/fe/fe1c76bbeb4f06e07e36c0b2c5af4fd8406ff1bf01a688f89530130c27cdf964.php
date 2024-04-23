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

/* registration/fourth_page.twig */
class __TwigTemplate_c9b5b275bfd0463060c9900eb98c243756b0e792ecfcb4523754a2d1719c462f extends \Twig\Template
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
        echo "<div data-block=\"pages\" id=\"fourth-registration-page\" class=\"hide\">
    ";
        // line 2
        if (($this->getAttribute(($context["data"] ?? null), "is_auth", []) != 0)) {
            // line 3
            echo "        <div class=\"registration-photo\">
            <div class=\"g-flatty-block\">
                <div id=\"user_photo\" class=\"photo-block\">
                  ";
            // line 6
            $module =             null;
            $helper =             'users';
            $name =             'formatAvatar';
            $params = array(["user" => ($context["item"] ?? null), "size" => "great", "class" => "img-circle img-responsive"]            ,            );
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
            // line 7
            echo "                    <div>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("upload_photo"            ,"users"            ,            );
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
                <div class=\"description-block\">
                    <div class=\"user-info\">
                        <div>";
            // line 11
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "output_name", []);
            echo ", ";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "age", []);
            echo "</div>
                        ";
            // line 12
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "user", []), "location", []);
            echo "
                    </div>
                    <div>";
            // line 14
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_upload_photo"            ,"users"            ,            );
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
                <div class=\"form-group\">
                    <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        ";
            // line 18
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("like_me"            ,            );
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
            $context['is_module_installed'] = $result;
            // line 19
            echo "                    <a onclick=\"";
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("index"            ,"btn_register_step4"            ,            );
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
            echo "locationHref('";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "links", []), "like_me", []);
            echo "');return false;\" data-action=\"rebuild-view\" class=\"btn btn-primary btn-block btn-lg\"
                       href=\"#\">";
            // line 20
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_next"            ,"start"            ,            );
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
                <div class=\"clearfix\"></div>
            </div>
         ";
            // line 26
            echo "        </div>
    ";
        }
        // line 28
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "registration/fourth_page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 28,  199 => 26,  172 => 20,  146 => 19,  125 => 18,  99 => 14,  94 => 12,  88 => 11,  61 => 7,  40 => 6,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "registration/fourth_page.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/registration/fourth_page.twig");
    }
}
