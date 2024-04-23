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

/* helper_user_media_block.twig */
class __TwigTemplate_de3b6bc2f01808ef0b136498569be662fa934b25df6dc7a88d9b7129c3884376 extends \Twig\Template
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
        echo "<div class=\"clearfix user-media-block\" id=\"user_recent_photos\">
    ";
        // line 3
        echo ($context["user_media_block"] ?? null);
        echo "
</div>
<script>
    \$(function () {
        loadScripts(
                \"";
        // line 8
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
                        idUser: '";
        // line 14
        echo ($context["id_user"] ?? null);
        echo "',
                        all_loaded: 1,
                        btnOk: \"";
        // line 16
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
        // line 17
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
                        lang_delete_confirm: '";
        // line 18
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
        // line 19
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
                        galleryContentDiv: 'user_recent_photos',
                        post_data: {filter_duplicate: 1},
                        load_on_scroll: false,
                        direction: 'desc',
                        refreshRecentPhotosDiv: '#user_recent_photos',
                        refreshRecentPhotosButton: '#refresh_user_recent_photos',
                        recentMediaUrl: 'media/ajax_get_user_recent_media',
                        recentPhotos: ";
        // line 27
        echo ($context["user_media_count"] ?? null);
        echo ",
                        recentTemplate: '";
        // line 28
        echo ($context["recent_template"] ?? null);
        echo "'
                    });
                },
                'recent_mediagallery',
                {async: false}
        );
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_user_media_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 28,  175 => 27,  145 => 19,  122 => 18,  99 => 17,  76 => 16,  71 => 14,  43 => 8,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_user_media_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\media\\views\\flatty\\helper_user_media_block.twig");
    }
}
