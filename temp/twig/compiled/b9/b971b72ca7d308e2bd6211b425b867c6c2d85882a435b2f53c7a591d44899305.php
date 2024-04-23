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

/* view_list.twig */
class __TwigTemplate_664578282867a0edc43ee327f61758d7bc0650e498c927782dffcb27c884690f extends \Twig\Template
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
        if ((($context["media_count"] ?? null) && ($this->getAttribute(($context["album"] ?? null), "media_count", []) > ($context["media_count"] ?? null)))) {
            // line 2
            echo "    <div class=\"fixmargin mtb5\">
        ";
            // line 3
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_permissions_for_view_part"            ,"media"            ,            );
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
            echo "    </div>
";
        }
        // line 6
        echo "
";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["media"] ?? null));
        $context['_iterated'] = false;
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
            // line 8
            echo "    <div class=\"g-users-gallery__item col-xs-6 col-sm-6 col-md-4 col-lg-3 ";
            if (($this->getAttribute($context["item"], "id_owner", []) != $this->getAttribute($context["item"], "id_user", []))) {
                echo " highlight-fav ";
            }
            echo "\">
        <div class=\"g-users-gallery__content\">
            ";
            // line 10
            if (($this->getAttribute($context["item"], "upload_gid", []) == "gallery_audio")) {
                // line 11
                echo "                ";
                $this->loadTemplate("view_audio_item.twig", "view_list.twig", 11)->display($context);
                // line 12
                echo "            ";
            } else {
                // line 13
                echo "            <div class=\"g-users-gallery__photo\">
                <a class=\"g-pic-border g-rounded g-users-gallery__photo-img\" href=\"javascript:void(0);\" data-click=\"view-media\" data-id-media=\"";
                // line 14
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                    ";
                // line 15
                if ($this->getAttribute($context["item"], "video_content", [])) {
                    // line 16
                    echo "                        <div class=\"g-users-gallery__overlay-icon pointer\">
                            <i class=\"fa fa-play w fa-4x opacity60\"></i>
                        </div>
                    ";
                }
                // line 20
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
                // line 21
                echo "                    <img src=\"";
                ob_start(function () { return ''; });
                // line 22
                echo "                         ";
                if ($this->getAttribute($context["item"], "video_content", [])) {
                    // line 23
                    echo "                             ";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "video_content", []), "thumbs", []), "big", []);
                    echo "
                         ";
                } elseif ($this->getAttribute(                // line 24
$context["item"], "media", [])) {
                    // line 25
                    echo "                             ";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "media", []), "mediafile", []), "thumbs", []), "big", []);
                    echo "
                         ";
                }
                // line 27
                echo "                         ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                echo "\" alt=\"";
                echo ($context["text_media_photo"] ?? null);
                echo "\" title=\"";
                echo ($context["text_media_photo"] ?? null);
                echo "\" />
                    </a>
                    <div class=\"g-users-gallery__overlayinfo\">
                        <div class=\"g-photo-statuses\">                            
                            <div class=\"g-photo-statuses__actions\">
                                <div class=\"g-photo-statuses__action\">
                                    ";
                // line 33
                if (($this->getAttribute($context["item"], "id_parent", []) && (($this->getAttribute($context["item"], "media", []) &&  !$this->getAttribute($context["item"], "mediafile", [])) || ($this->getAttribute(                // line 34
$context["item"], "video_content", []) &&  !$this->getAttribute($context["item"], "media_video", []))))) {
                    // line 35
                    echo "                                    <div class=\"g-photo-statuses__item g-photo-statuses__item_place\" data-gid=\"media";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                        ";
                    // line 36
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("media_deleted_by_owner"                    ,"media"                    ,                    );
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
                    // line 37
                    echo "                                    </div>
                                    ";
                }
                // line 39
                echo "                                        <div class=\"g-photo-statuses__item g-photo-statuses__item_place\" data-gid=\"media";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                            <i class=\"far fa-eye edge w\">&nbsp;</i>
                                            <span class=\"view_num\">";
                // line 41
                echo $this->getAttribute($context["item"], "views", []);
                echo "</span>
                                        </div>
                                </div>
                                <div class=\"g-photo-statuses__action\">
                                        <div class=\"g-photo-statuses__item\">
                                            ";
                // line 46
                $module =                 null;
                $helper =                 'likes';
                $name =                 'like_block';
                $params = array(["gid" => ("media" . $this->getAttribute(                // line 47
($context["item"] ?? null), "id", [])), "type" => "button", "btn_class" => "edge w"]                ,                );
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
                // line 51
                echo "                                        </div>
                                        ";
                // line 52
                if ($this->getAttribute($context["item"], "is_adult", [])) {
                    // line 53
                    echo "                                            <div class=\"g-photo-statuses__item g-photo-statuses__item_place\">
                                                <i class=\"fa fa-female edge w\">&nbsp;</i>
                                                <span>18+</span>
                                            </div>
                                        ";
                }
                // line 58
                echo "                                        ";
                if (($this->getAttribute($context["item"], "id_user", []) != $this->getAttribute($context["item"], "id_owner", []))) {
                    // line 59
                    echo "                                            <div class=\"g-photo-statuses__item\" title=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("not_owner"                    ,"media"                    ,                    );
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
                    echo "\">
                                                <i class=\"far fa-file\"></i>
                                            </div>
                                        ";
                }
                // line 63
                echo "                                    </div>
                                    <div class=\"g-photo-statuses__action\">
                                        ";
                // line 65
                if ( !$this->getAttribute($context["item"], "is_owner", [])) {
                    // line 66
                    echo "                                            <div class=\"g-photo-statuses__item g-photo-statuses__item_place g-photo-statuses__item_btn\">
                                                ";
                    // line 67
                    $module =                     null;
                    $helper =                     'spam';
                    $name =                     'mark_as_spam_block';
                    $params = array(["object_id" => $this->getAttribute(                    // line 68
($context["item"] ?? null), "id", []), "type_gid" => "media_object", "template" => "whitebutton"]                    ,                    );
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
                    // line 72
                    echo "                                            </div>
                                        ";
                }
                // line 74
                echo "                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    ";
            }
            // line 80
            echo "                </div>
            </div>
            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 83
            echo "                <div class=\"center\">
                    ";
            // line 84
            if ($this->getAttribute(($context["album"] ?? null), "media_count", [])) {
                // line 85
                echo "                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("no_permissions_for_view_all"                ,"media"                ,                );
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
                // line 86
                echo "                    ";
            } else {
                // line 87
                echo "                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("no_media"                ,"media"                ,                );
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
                // line 88
                echo "                    ";
            }
            // line 89
            echo "                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "view_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  391 => 89,  388 => 88,  366 => 87,  363 => 86,  341 => 85,  339 => 84,  336 => 83,  321 => 80,  313 => 74,  309 => 72,  291 => 68,  287 => 67,  284 => 66,  282 => 65,  278 => 63,  251 => 59,  248 => 58,  241 => 53,  239 => 52,  236 => 51,  218 => 47,  214 => 46,  206 => 41,  200 => 39,  196 => 37,  175 => 36,  170 => 35,  168 => 34,  167 => 33,  153 => 27,  147 => 25,  145 => 24,  140 => 23,  137 => 22,  134 => 21,  112 => 20,  106 => 16,  104 => 15,  100 => 14,  97 => 13,  94 => 12,  91 => 11,  89 => 10,  81 => 8,  63 => 7,  60 => 6,  56 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "view_list.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/view_list.twig");
    }
}
