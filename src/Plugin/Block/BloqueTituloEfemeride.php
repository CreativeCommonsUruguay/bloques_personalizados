<?php

namespace Drupal\bloques_personalizados\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "titulo_efemerides_block",
 *   admin_label = @Translation("Titulo efemerides block"),
 *   category = @Translation("Titulo efemerides"),
 * )
 */
class BloqueTituloEfemeride extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

$dia = date ('j');
//$mesEng = strtolower (date ('F'));
//$mes = t($mesEng);
$mes = format_date(time() , 'custom', "F", NULL, NULL); //Marco 2018-1-2

$resultado = "<div class='resaltado3'>
  <span class='titulo-secundario'>Un día como hoy</div>
</div>
<div>
  <h2 class='titulo-principal resaltado1'>".$dia." de ".$mes."</h2>
</div>";




    return array(
      '#markup' => $resultado,
      '#allowed_tags' => ['div', 'span', 'h2'],
      '#cache' => array('max-age' => 0), // Fijo el cache del bloque en 1 hora.
      );
  }

}

