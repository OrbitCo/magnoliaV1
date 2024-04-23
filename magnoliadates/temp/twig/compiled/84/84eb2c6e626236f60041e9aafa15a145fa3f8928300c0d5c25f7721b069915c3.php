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

/* media_all.twig */
class __TwigTemplate_26543913a425a5e3a47fa24052ad129353480beb13043bbeb49b56b62d19d3ec extends \Twig\Template
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
        echo "<div data-page=\"";
        echo ($context["current_page"] ?? null);
        echo "\">
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["media"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
            // line 3
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["block"], "items", []));
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
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 4
                echo "            <div class=\"g-users-gallery__item col-xs-6 col-sm-4 col-md-3 col-lg-2 ";
                echo $this->getAttribute(($context["icons"] ?? null), $context["key"], [], "array");
                echo "\">
                <div class=\"g-users-gallery__content\">
                    ";
                // line 6
                if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_audio")) {
                    // line 7
                    echo "                        ";
                    $this->loadTemplate("view_audio_item.twig", "media_all.twig", 7)->display($context);
                    // line 8
                    echo "                    ";
                } else {
                    // line 9
                    echo "                        <div class=\"g-users-gallery__photo\">
                            <a class=\"g-pic-border g-rounded g-users-gallery__photo-img\" href=\"";
                    // line 10
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "link", []);
                    echo "\" data-click=\"view-media\" data-place=\"site_gallery\" data-id-media=\"";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                ";
                    // line 11
                    if ($this->getAttribute($context["item"], "video_content", [])) {
                        // line 12
                        echo "                                    <div class=\"g-users-gallery__overlay-icon pointer\">
                                        <i class=\"fa fa-play w fa-4x opacity60\"></i>
                                    </div>
                                ";
                    }
                    // line 15
                    echo "                                
                                ";
                    // line 16
                    $module =                     null;
                    $helper =                     'media';
                    $name =                     'load_picture';
                    $params = array(["thumbs" => (($this->getAttribute($this->getAttribute($this->getAttribute(                    // line 17
($context["item"] ?? null), "media", []), "mediafile", []), "thumbs", [])) ? ($this->getAttribute($this->getAttribute($this->getAttribute(($context["item"] ?? null), "media", []), "mediafile", []), "thumbs", [])) : ($this->getAttribute($this->getAttribute(($context["item"] ?? null), "video_content", []), "thumbs", []))), "size" => $this->getAttribute(                    // line 18
($context["icons"] ?? null), ($context["key"] ?? null), [], "array"), "alt" =>                     // line 19
($context["text_media_photo"] ?? null), "class" => "pointer"]                    ,                    );
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
                    echo "                                
                            </a>
                            <div class=\"g-users-gallery__overlayinfo\">
                                <div class=\"g-photo-statuses\">
                                    <div class=\"g-photo-statuses__item\">
                                        ";
                    // line 26
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("text_media_photo"                    ,"media"                    ,""                    ,"button"                    ,($context["item"] ?? null)                    ,                    );
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
                    // line 27
                    echo "                                    </div>

                                    <div class=\"g-photo-statuses__item\">
                                        ";
                    // line 30
                    $module =                     null;
                    $helper =                     'likes';
                    $name =                     'like_block';
                    $params = array(["gid" => ("media" . $this->getAttribute(                    // line 31
($context["item"] ?? null), "id", [])), "type" => "button", "btn_class" => "edge w"]                    ,                    );
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
                    // line 35
                    echo "                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
                // line 40
                echo "
                    <div class=\"g-users-gallery__info\">
                        <div class=\"text-overflow\">
                            <a data-action=\"set_user_ids\" data-gid=\"media\"  class=\"g-users-gallery__name\" title=\"";
                // line 43
                echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "output_name", []);
                echo ", ";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "age", []);
                echo "\" target=\"_blank\" data-href=\"";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "link", []);
                echo "\" href=\"";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "link", []);
                echo "\">";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "output_name", []);
                echo "</a>, ";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_info", []), "age", []);
                echo "
                        </div>
                        ";
                // line 46
                echo "                    </div>
                </div>
            </div>
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
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "media_all.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  239 => 51,  210 => 46,  195 => 43,  190 => 40,  183 => 35,  165 => 31,  161 => 30,  156 => 27,  135 => 26,  128 => 21,  110 => 19,  109 => 18,  108 => 17,  104 => 16,  101 => 15,  95 => 12,  93 => 11,  87 => 10,  84 => 9,  81 => 8,  78 => 7,  76 => 6,  70 => 4,  52 => 3,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "media_all.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/media_all.twig");
    }
}
