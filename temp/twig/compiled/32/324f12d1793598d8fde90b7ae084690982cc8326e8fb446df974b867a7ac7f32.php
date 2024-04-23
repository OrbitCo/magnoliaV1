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

/* wall_events_wall_post.twig */
class __TwigTemplate_fadabf491e8400e210165a0c1e6e4d7729a737565845a03b8cd3a48f77bd841c extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["event"] ?? null), "data", []));
        foreach ($context['_seq'] as $context["key"] => $context["edata"]) {
            // line 2
            echo "    <span class=\"wall-post-date\">";
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["event"] ?? null), "date_update", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
            echo "</span>
    <button id=\"otheractions_";
            // line 3
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "\" type=\"button\" class=\"btn btn-default wall-otheractions\" data-toggle=\"popover\" data-placement=\"bottom\">
        <i class=\"fa fa-ellipsis-h\"></i>
    </button>
    <div id=\"otheractions_";
            // line 6
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "_template\" class=\"hide otheractions_content\">
        <ul>
            ";
            // line 8
            if ((($this->getAttribute(($context["event"] ?? null), "id_wall", []) == ($context["user_id"] ?? null)) || ($this->getAttribute(($context["event"] ?? null), "id_poster", []) == ($context["user_id"] ?? null)))) {
                // line 9
                echo "                <li class=\"js-delete_wall_event\" data-id=\"";
                echo $this->getAttribute(($context["event"] ?? null), "id", []);
                echo "\"
                       data-message=\"";
                // line 10
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("confirm_delete"                ,"wall_events"                ,                );
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
                    <a href=\"javascript:void(0);\" class=\"js-delete_wall_event\" data-id=\"";
                // line 11
                echo $this->getAttribute(($context["event"] ?? null), "id", []);
                echo "\"
                       data-message=\"";
                // line 12
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("confirm_delete"                ,"wall_events"                ,                );
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
                       ";
                // line 13
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_delete_post"                ,"wall_events"                ,                );
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
                // line 14
                echo "                    </a>
                </li>
                <script>
                    \$('.js-delete_wall_event').off('click').on('click', function () {
                        wall.bind_delete();
                    });
                </script>
            ";
            }
            // line 22
            echo "            ";
            if (($this->getAttribute(($context["event"] ?? null), "id_poster", []) != ($context["user_id"] ?? null))) {
                // line 23
                echo "                ";
                $module =                 null;
                $helper =                 'spam';
                $name =                 'mark_as_spam_block';
                $params = array(["object_id" => $this->getAttribute(                // line 24
($context["event"] ?? null), "id", []), "type_gid" => "wall_events_object", "view_type" => "drpdwn_li"]                ,                );
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
                // line 28
                echo "            ";
            }
            // line 29
            echo "        </ul>
    </div>
    <script type=\"text/javascript\">
        \$(function () {
            \$('#otheractions_";
            // line 33
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "').popover({
                html: true,
                content: function () {
                    var clone = \$(\$('#otheractions_";
            // line 36
            echo $this->getAttribute(($context["event"] ?? null), "id", []);
            echo "_template')).clone(true).removeClass('hide');
                    return clone;
                }
            });

        });
    </script>

    ";
            // line 44
            if ($this->getAttribute($context["edata"], "text", [])) {
                // line 45
                echo "        <div class=\"wall-post-content\">
            ";
                // line 46
                echo $this->getAttribute($context["edata"], "text", []);
                echo "
        </div>
    ";
            }
            // line 49
            echo "
    ";
            // line 50
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "media", []), $context["key"], [], "array"), "img", [])) {
                // line 51
                echo "        <div class=\"wall-gallery\" gallery=\"wall_";
                echo $this->getAttribute(($context["event"] ?? null), "id", []);
                echo "\">
            ";
                // line 52
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "media", []), $context["key"], [], "array"), "img", []));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 53
                    echo "                <div class=\"g-pic-border g-rounded\">
                <img src=\"";
                    // line 54
                    ob_start(function () { return ''; });
                    // line 55
                    echo "                    ";
                    if ((($context["i"] ?? null) > 8)) {
                        // line 56
                        echo "                        ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "thumbs", []), "middle", []);
                        echo "
                    ";
                    } else {
                        // line 58
                        echo "                        ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "thumbs", []), "big", []);
                        echo "
                    ";
                    }
                    // line 60
                    echo "                    ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    echo "\" gallery-src=\"";
                    echo $this->getAttribute($this->getAttribute($context["item"], "thumbs", []), "grand", []);
                    echo "\"
                            alt=\"";
                    // line 61
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "photo_alt", []));
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "photo_title", []));
                    echo "\" />
                </div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 64
                echo "        </div>
    ";
            }
            // line 66
            echo "
    ";
            // line 67
            if ( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "media", []), $context["key"], [], "array"), "video", []))) {
                // line 68
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "media", []), $context["key"], [], "array"), "video", []));
                foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                    // line 69
                    echo "            <div class=\"pt5\">
                ";
                    // line 70
                    if (($this->getAttribute($context["item"], "status", []) == "start")) {
                        // line 71
                        echo "                    <div>
                        ";
                        // line 72
                        echo $this->getAttribute($context["item"], "file_name", []);
                        echo "
                    </div>
                    <div class=\"error-text\">
                        ";
                        // line 75
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("video_converting"                        ,"wall_events"                        ,                        );
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
                        // line 76
                        echo "                    </div>
                ";
                    } elseif ($this->getAttribute(                    // line 77
$context["item"], "errors", [])) {
                        // line 78
                        echo "                    <div>
                        ";
                        // line 79
                        echo $this->getAttribute($context["item"], "file_name", []);
                        echo "
                    </div>
                    ";
                        // line 81
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "errors", []));
                        foreach ($context['_seq'] as $context["_key"] => $context["err"]) {
                            // line 82
                            echo "                        <div class=\"error-text\">
                            ";
                            // line 83
                            echo $context["err"];
                            echo "
                        </div>
                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['err'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 86
                        echo "                ";
                    } elseif ($this->getAttribute($context["item"], "embed", [])) {
                        // line 87
                        echo "                    <div>
                        ";
                        // line 88
                        echo $this->getAttribute($context["item"], "embed", []);
                        echo "
                    </div>
                ";
                    }
                    // line 91
                    echo "            </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 93
                echo "    ";
            }
            // line 94
            echo "
    ";
            // line 95
            if ( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "media", []), $context["key"], [], "array"), "audio", []))) {
                // line 96
                echo "
        ";
                // line 97
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "media", []), $context["key"], [], "array"), "audio", []));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 98
                    echo "            ";
                    $context["rand_id"] = twig_random($this->env, 10000);
                    // line 99
                    echo "            <div class=\"audio-content\" data-id-media=\"";
                    echo ($context["rand_id"] ?? null);
                    echo "\">
                <audio id=\"player_";
                    // line 100
                    echo ($context["rand_id"] ?? null);
                    echo "\" preload=\"auto\" src=\"";
                    echo $this->getAttribute($context["item"], "file_url", []);
                    echo "\"></audio>
                <div id=\"play_";
                    // line 101
                    echo ($context["rand_id"] ?? null);
                    echo "\" class=\"play-track\" ><i class=\"fa fa-play fa-lg\"></i></div>
                <div id=\"duration_";
                    // line 102
                    echo ($context["rand_id"] ?? null);
                    echo "\" class=\"duration-time duration_";
                    echo ($context["rand_id"] ?? null);
                    echo "\"></div>
                <div id=\"audioname_";
                    // line 103
                    echo ($context["rand_id"] ?? null);
                    echo "\" class=\"audio-name audioname_";
                    echo ($context["rand_id"] ?? null);
                    echo "\">
                    <span ";
                    // line 104
                    if ( !twig_test_empty($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "data", []), 0, [], "array"), "audios", [], "array"), twig_replace_filter($this->getAttribute($context["item"], "file_name", []), [".mp3" => "", ".wav" => ""]), [], "array"), "song_lyrisc", []))) {
                        // line 105
                        echo "                        class=\"audio-lyrics-link\" onclick=\"\$('#lyrics";
                        echo ($context["rand_id"] ?? null);
                        echo "').toggle();\"
                        ";
                    }
                    // line 106
                    echo ">
                        ";
                    // line 107
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "data", []), 0, [], "array"), "audios", [], "array"), twig_replace_filter($this->getAttribute($context["item"], "file_name", []), [".mp3" => "", ".wav" => ""]), [], "array"), "song_name", []);
                    echo "
                    </span>
                </div>
                <div id=\"timeline_";
                    // line 110
                    echo ($context["rand_id"] ?? null);
                    echo "\" class=\"timeline timeline_";
                    echo ($context["rand_id"] ?? null);
                    echo " list-timeline timeline-hide\">
                    <div id=\"playhead_";
                    // line 111
                    echo ($context["rand_id"] ?? null);
                    echo "\" class=\"playhead playhead_";
                    echo ($context["rand_id"] ?? null);
                    echo "\"></div>
                </div>
                <div class=\"audio-song-lyrics-block hide\" id=\"lyrics";
                    // line 113
                    echo ($context["rand_id"] ?? null);
                    echo "\">
                    <span>
                        ";
                    // line 115
                    echo nl2br(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["event"] ?? null), "data", []), 0, [], "array"), "audios", [], "array"), twig_replace_filter($this->getAttribute($context["item"], "file_name", []), [".mp3" => "", ".wav" => ""]), [], "array"), "song_lyrics", []), "html", null, true));
                    echo "
                    </span>
                </div>
            </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 120
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['edata'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "wall_events_wall_post.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  460 => 120,  449 => 115,  444 => 113,  437 => 111,  431 => 110,  425 => 107,  422 => 106,  416 => 105,  414 => 104,  408 => 103,  402 => 102,  398 => 101,  392 => 100,  387 => 99,  384 => 98,  380 => 97,  377 => 96,  375 => 95,  372 => 94,  369 => 93,  362 => 91,  356 => 88,  353 => 87,  350 => 86,  341 => 83,  338 => 82,  334 => 81,  329 => 79,  326 => 78,  324 => 77,  321 => 76,  300 => 75,  294 => 72,  291 => 71,  289 => 70,  286 => 69,  281 => 68,  279 => 67,  276 => 66,  272 => 64,  261 => 61,  254 => 60,  248 => 58,  242 => 56,  239 => 55,  237 => 54,  234 => 53,  230 => 52,  225 => 51,  223 => 50,  220 => 49,  214 => 46,  211 => 45,  209 => 44,  198 => 36,  192 => 33,  186 => 29,  183 => 28,  165 => 24,  160 => 23,  157 => 22,  147 => 14,  126 => 13,  103 => 12,  99 => 11,  76 => 10,  71 => 9,  69 => 8,  64 => 6,  58 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "wall_events_wall_post.twig", "/home/mliadov/public_html/application/modules/wall_events/views/flatty/wall_events_wall_post.twig");
    }
}
