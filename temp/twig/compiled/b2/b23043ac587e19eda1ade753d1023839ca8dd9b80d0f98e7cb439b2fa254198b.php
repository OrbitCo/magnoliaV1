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

/* user_media_block.twig */
class __TwigTemplate_039d73565295f6d4ec3bb933584a965819e488a15032c455f8a136821f99b995 extends \Twig\Template
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
        echo "
";
        // line 2
        $context["thumb_name"] = $this->getAttribute(($context["recent_thumb"] ?? null), "name", []);
        // line 3
        echo "<div class=\"pointer\">
    <i class=\"fa fa-camera\"></i>
    <a href=\"";
        // line 5
        echo ($context["gallery_link"] ?? null);
        echo "\">";
        echo ($context["user_media_count"] ?? null);
        echo "&nbsp;";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_user_photos"        ,"media"        ,        );
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
<div class=\"media-items clearfix\">
    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["recent_photos_data"] ?? null), "media", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 9
            echo "        <div class=\"media-items_frame-img\">
            <span  class=\"a fleft  ";
            // line 10
            if (($context["no_acces_gallery"] ?? null)) {
                echo " no_access ";
            }
            echo "\" data-click=\"view-media\" data-user-id=\"";
            echo $this->getAttribute($context["item"], "id_owner", []);
            echo "\" data-id-media=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                ";
            // line 11
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_video")) {
                // line 12
                echo "                    ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_media_video"                ,"media"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_media_video'] = $result;
                // line 13
                echo "                    <img class=\" img-responsive\" src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "video_content", []), "thumbs", []), ($context["thumb_name"] ?? null), [], "array");
                echo "\" width=\"";
                echo $this->getAttribute(($context["recent_thumb"] ?? null), "width", []);
                echo "\"  ";
                if ( !($context["no_acces_gallery"] ?? null)) {
                    echo " alt=\"";
                    echo ($context["text_media_video"] ?? null);
                    echo "\" title=\"";
                    echo ($context["text_media_video"] ?? null);
                    echo "\" ";
                }
                echo " />
                ";
            } else {
                // line 15
                echo "                    ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("text_media_photo"                ,"media"                ,""                ,"button"                ,($context["item"] ?? null)                ,                );
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
                $context['text_media_photo'] = $result;
                // line 16
                echo "                    <img class=\" img-responsive\" src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "thumbs", []), ($context["thumb_name"] ?? null), [], "array");
                echo "\" width=\"";
                echo $this->getAttribute(($context["recent_thumb"] ?? null), "width", []);
                echo "\"  ";
                if ( !($context["no_acces_gallery"] ?? null)) {
                    echo "  alt=\"";
                    echo ($context["text_media_photo"] ?? null);
                    echo "\" title=\"";
                    echo ($context["text_media_photo"] ?? null);
                    echo "\" ";
                }
                echo " />
                ";
            }
            // line 18
            echo "            </span>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo " 
</div>

";
        // line 23
        if (($context["no_acces_gallery"] ?? null)) {
            echo " 
<script type=\"text/javascript\">
    \$(function(){
        \$('#user_recent_photos [data-click=\"view-media\"]').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            location.href = \"";
            // line 29
            echo ($context["access_permissions_link"] ?? null);
            echo "\";
        });
    });
</script>
";
        }
    }

    public function getTemplateName()
    {
        return "user_media_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  185 => 29,  176 => 23,  171 => 20,  163 => 18,  147 => 16,  125 => 15,  109 => 13,  87 => 12,  85 => 11,  75 => 10,  72 => 9,  68 => 8,  39 => 5,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_media_block.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/user_media_block.twig");
    }
}
