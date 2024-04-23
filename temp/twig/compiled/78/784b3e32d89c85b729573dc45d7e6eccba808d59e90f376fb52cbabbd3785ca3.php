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

/* homepage.twig */
class __TwigTemplate_b065b0bc01f0fcf88b8131eefdb0517c4711d0b55005da2079c1d7391aa5bd49 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "homepage.twig", 1)->display($context);
        // line 2
        echo "<!--Profile -->\t\t\t\t\t
<div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">
    <div class=\"hide-in-mobile user-profile-view\">
        ";
        // line 5
        $module =         null;
        $helper =         'users';
        $name =         'get_preview';
        $params = array(["page_name" => "homepage"]        ,        );
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
        // line 6
        echo "        ";
        $module =         null;
        $helper =         'media';
        $name =         'user_media_block';
        $params = array(["count" => 9, "user_id" => ($context["user_id"] ?? null)]        ,        );
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
        echo "    </div>    
</div>
<!--Profile -->
";
        // line 10
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("wall_events"        ,        );
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
        // line 11
        echo "<div class=\"col-xs-12 col-sm-9 col-md-6 col-lg-6\">
    ";
        // line 12
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "wall_events", [])) {
            // line 13
            echo "        <div class=\"g-flatty-block\">
            ";
            // line 14
            $module =             null;
            $helper =             'wall_events';
            $name =             'wall_block';
            $params = array(["place" => "homepage", "id_wall" => ($context["user_id"] ?? null)]            ,            );
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
            echo "        
        </div>
    ";
        }
        // line 17
        echo "</div>
<div class=\"col-xs-12 col-sm-9 col-md-3 col-lg-3 pull-right\">
    <div id=\"active_users\" class=\"clearfix mb10\">
        ";
        // line 20
        $module =         null;
        $helper =         'users';
        $name =         'active_users_block';
        $params = array(["count" => "16"]        ,        );
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
        // line 21
        echo "    </div>
    <div id=\"recent_photo\" class=\"clearfix mb10\">
        ";
        // line 23
        $module =         null;
        $helper =         'media';
        $name =         'recent_media_block';
        $params = array(["upload_gid" => "photo", "count" => "16"]        ,        );
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
        // line 24
        echo "    </div> 
    <div id=\"bonuses\" class=\"clearfix mb10\">
        ";
        // line 26
        $module =         null;
        $helper =         'bonuses';
        $name =         'bonuses_form';
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
        echo "   
    </div>    
</div>
";
        // line 29
        $this->loadTemplate("@app/footer.twig", "homepage.twig", 29)->display($context);
    }

    public function getTemplateName()
    {
        return "homepage.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 29,  194 => 26,  190 => 24,  169 => 23,  165 => 21,  144 => 20,  139 => 17,  114 => 14,  111 => 13,  109 => 12,  106 => 11,  85 => 10,  80 => 7,  58 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "homepage.twig", "/home/mliadov/public_html/application/modules/start/views/flatty/homepage.twig");
    }
}
