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

/* helper_recent_media.twig */
class __TwigTemplate_c7f920d38dbee9c6ad4f2af9d063ae6c37724517773b137de7f5ffe64e653031 extends \Twig\Template
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
        $context["thumb_name"] = $this->getAttribute(($context["recent_thumb"] ?? null), "name", []);
        // line 2
        echo "<div class=\"recent-photos clearfix\" id=\"recent_photos\">
    <div class=\"title-block\" data-title=\"";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_recent_photos"        ,"media"        ,        );
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
        echo "\" data-id=\"recent-photos-title\" id=\"recent-photos-title\">
        <span>
            ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_recent_photos"        ,"media"        ,        );
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
        echo "        </span>
        <span class=\"fright\" id=\"refresh_recent_photos\">
            <i class=\"fas fa-sync\"></i>
        </span>
    </div>
    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["recent_photos_data"] ?? null), "media", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 12
            echo "        <span class=\"a fleft ";
            if ((($context["no_acces_gallery"] ?? null) && ($this->getAttribute($context["item"], "id_owner", []) != ($context["current_user"] ?? null)))) {
                echo " no_access ";
            }
            // line 13
            echo "        \" data-click=\"view-media\"
              data-user-id=\"";
            // line 14
            echo $this->getAttribute($context["item"], "id_owner", []);
            echo "\"
              data-id-media=\"";
            // line 15
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">

                ";
            // line 17
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_media_photo"            ,"media"            ,""            ,"button"            ,($context["item"] ?? null)            ,            );
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
            // line 18
            echo "                <img class=\"small\" src=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "thumbs", []), ($context["thumb_name"] ?? null), [], "array");
            echo "\"
                     width=\"";
            // line 19
            echo $this->getAttribute(($context["recent_thumb"] ?? null), "width", []);
            echo "\" alt=\"";
            echo ($context["text_media_photo"] ?? null);
            echo "\"
                     title=\"";
            // line 20
            echo ($context["text_media_photo"] ?? null);
            echo "\" />

        </span>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "</div>
<script>
    \$(function () {
        loadScripts(
                \"";
        // line 28
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("media"        ,"../views/flatty/js/media.js"        ,"path"        ,        );
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
                    recent_mediagallery = new media({
                        siteUrl: site_url,
                        gallery_name: 'recent_mediagallery',
                        galleryContentPage: 1,
                        idUser: 0,
                        btnOk: \"";
        // line 35
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_ok"        ,"start"        ,        );
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
                        btnCancel: \"";
        // line 36
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
                        all_loaded: 1,
                        lang_delete_confirm: '";
        // line 38
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm"        ,"media"        ,""        ,"js"        ,        );
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
                        lang_delete_confirm_album: '";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("delete_confirm_albums"        ,"media"        ,""        ,"js"        ,        );
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
                        galleryContentDiv: 'recent_photos',
                        post_data: {filter_duplicate: 1},
                        load_on_scroll: false,
                        direction: 'desc'
                    });
                },
                'recent_mediagallery',
                {async: false}
        );
    });
</script>

";
        // line 52
        if (($context["no_acces_gallery"] ?? null)) {
            // line 53
            echo "<script type=\"text/javascript\">
    \$(function(){
        \$('.recent-photos [data-click=\"view-media\"].no_access').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            location.href = \"";
            // line 58
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
        return "helper_recent_media.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  299 => 58,  292 => 53,  290 => 52,  255 => 39,  232 => 38,  208 => 36,  185 => 35,  156 => 28,  150 => 24,  140 => 20,  134 => 19,  129 => 18,  108 => 17,  103 => 15,  99 => 14,  96 => 13,  91 => 12,  87 => 11,  80 => 6,  59 => 5,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_recent_media.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\media\\views\\flatty\\helper_recent_media.twig");
    }
}
