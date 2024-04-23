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

/* moder_block.twig */
class __TwigTemplate_8b2fdde4507b6f6a789d719ff814d1404eef560547b0ebf17bc05bfb32436d6d extends \Twig\Template
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
        echo "<div class=\"view-user\">
    ";
        // line 3
        echo "        <div class=\"form-group\">
            ";
        // line 4
        if ($this->getAttribute(($context["data"] ?? null), "user_logo_moderation", [])) {
            // line 5
            echo "                ";
            $context["source"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo_moderation", []), "thumbs", []), "big", []);
            // line 6
            echo "                ";
            $context["file_url"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo_moderation", []), "file_url", []);
            // line 7
            echo "            ";
        } else {
            // line 8
            echo "                ";
            $context["source"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "thumbs", []), "big", []);
            // line 9
            echo "                ";
            $context["file_url"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "file_url", []);
            // line 10
            echo "            ";
        }
        // line 11
        echo "            <a href=\"";
        echo ($context["file_url"] ?? null);
        echo "\" target=\"_blank\">
                <img src=\"";
        // line 12
        echo ($context["source"] ?? null);
        echo "\" class=\"img-responsive\">
            </a>
            <br>
            <label>";
        // line 15
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("media_owner"        ,"media"        ,        );
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
        echo ":</label>&nbsp;
            <a href=\"";
        // line 16
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/";
        echo $this->getAttribute(($context["data"] ?? null), "id", []);
        echo "\" target=\"_blank\" >
                ";
        // line 17
        echo $this->getAttribute(($context["data"] ?? null), "output_name", []);
        echo "
            </a><br>
        </div>
    ";
        // line 21
        echo "    <div class=\"logo-cont form-group\">
        ";
        // line 22
        if (($this->getAttribute(($context["data"] ?? null), "fname", []) || $this->getAttribute(($context["data"] ?? null), "sname", []))) {
            // line 23
            echo "            <label>";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_name"            ,"users"            ,            );
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
            echo ":</label>
            <a href=\"";
            // line 24
            echo ($context["site_url"] ?? null);
            echo "admin/users/edit/personal/";
            echo $this->getAttribute(($context["data"] ?? null), "id", []);
            echo "\" target=\"_blank\">
                ";
            // line 25
            echo $this->getAttribute(($context["data"] ?? null), "output_name", []);
            echo "
            </a>
            <br/>
        ";
        }
        // line 29
        echo "    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "moder_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 29,  137 => 25,  131 => 24,  107 => 23,  105 => 22,  102 => 21,  96 => 17,  90 => 16,  67 => 15,  61 => 12,  56 => 11,  53 => 10,  50 => 9,  47 => 8,  44 => 7,  41 => 6,  38 => 5,  36 => 4,  33 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "moder_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\gentelella\\moder_block.twig");
    }
}
