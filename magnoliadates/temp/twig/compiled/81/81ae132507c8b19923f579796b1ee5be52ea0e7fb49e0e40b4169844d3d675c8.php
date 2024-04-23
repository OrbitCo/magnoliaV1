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

/* helper_membership_change.twig */
class __TwigTemplate_920fb271be437c35d2d9e76248754f46398d35d7904611b5f34f27c0bd1e171e extends \Twig\Template
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
        if (($this->getAttribute(($context["user_data"] ?? null), "type", []) == "btn")) {
            // line 2
            echo "    <a data-action=\"membership-change\" 
             data-id_user=\"";
            // line 3
            echo $this->getAttribute(($context["user_data"] ?? null), "id_user", []);
            echo "\" 
             data-groups=\"";
            // line 4
            echo $this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "group", []), "group_gid", []);
            echo "\" data-days=\"";
            echo $this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "group", []), "left_str", []);
            echo "\"
             ";
            // line 5
            if ($this->getAttribute(($context["user_data"] ?? null), "user_type", [])) {
                echo "data-user_type=\"";
                echo $this->getAttribute(($context["user_data"] ?? null), "user_type", []);
                echo "\"";
            }
            // line 6
            echo "             id=\"user_membership_str-";
            echo $this->getAttribute(($context["user_data"] ?? null), "id_user", []);
            echo "\" 
             class=\"group_change_btn\">Membership</a>
";
        } elseif (($this->getAttribute(        // line 8
($context["user_data"] ?? null), "type", []) == "choise")) {
            // line 9
            echo "    <a data-groups='' data-id_user=\"\" data-action=\"membership-change\"  
             id=\"user_membership_choise\" class=\"cursor-pointer\">Membership</a>
";
        } else {
            // line 12
            echo "    <div data-action=\"membership-change\" 
             data-id_user=\"";
            // line 13
            echo $this->getAttribute(($context["user_data"] ?? null), "id_user", []);
            echo "\" 
             data-groups=\"";
            // line 14
            echo $this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "group", []), "group_gid", []);
            echo "\" data-days=\"";
            echo $this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "group", []), "left_str", []);
            echo "\"
             ";
            // line 15
            if ($this->getAttribute(($context["user_data"] ?? null), "user_type", [])) {
                echo "data-user_type=\"";
                echo $this->getAttribute(($context["user_data"] ?? null), "user_type", []);
                echo "\"";
            }
            // line 16
            echo "             id=\"user_membership_str-";
            echo $this->getAttribute(($context["user_data"] ?? null), "id_user", []);
            echo "\" 
             class=\"group_change_btn\">
        ";
            // line 18
            echo $this->getAttribute(($context["user_data"] ?? null), "group_str", []);
            echo "
        ";
            // line 19
            if ($this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "group", []), "date_expired", [])) {
                // line 20
                echo "            <div class=\"date-expires\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_expires"                ,"access_permissions"                ,                );
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
                echo " <div>";
                echo $this->getAttribute($this->getAttribute(($context["user_data"] ?? null), "group", []), "date_expired", []);
                echo "</div></div>
         ";
            }
            // line 22
            echo "    </div>
             
";
        }
    }

    public function getTemplateName()
    {
        return "helper_membership_change.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 22,  95 => 20,  93 => 19,  89 => 18,  83 => 16,  77 => 15,  71 => 14,  67 => 13,  64 => 12,  59 => 9,  57 => 8,  51 => 6,  45 => 5,  39 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_membership_change.twig", "/home/mliadov/public_html/application/modules/access_permissions/views/gentelella/helper_membership_change.twig");
    }
}
