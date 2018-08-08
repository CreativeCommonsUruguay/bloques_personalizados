<?php

namespace Drupal\bloques_personalizados\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "noticias_block",
 *   admin_label = @Translation("Noticias block"),
 *   category = @Translation("Noticias recientes"),
 * )
 */
class BloqueNoticias extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $nombreArchivo ="ultimos3posts.xml";

    $file = file_get_contents('public://'.$nombreArchivo, FILE_USE_INCLUDE_PATH);
    $resultado = "";
    if ($file) {
        $xml = new \SimpleXMLElement($file);

        $postfecha = "";
        $resultado ="<ul>";

        foreach ($xml->noticia as $cadanoticia)
        {
            $resultado.= "<li>";

            if (!empty($cadanoticia->fecha)) { $postfecha = $cadanoticia->fecha; }
            $postlink = $cadanoticia->link;
            $posttitulo = $cadanoticia->titulo;
        
            $resultado.= $postfecha.". <a href='".$postlink."' target=_blank>".$posttitulo."</a>";
            $resultado.= "</li>";
        }
    
        $resultado.="</ul>"; // $xmlStr;
    }
    return array(
      '#markup' => $resultado,
      '#allowed_tags' => ['div', 'a', 'ul', 'li'],
      '#cache' => array('max-age' => 3600), // Fijo el cache del bloque en 1 hora.
      );
  }

}



