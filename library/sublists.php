<?php 

function sublistTable($post_ID, $sublist, $permalinkmain, $allsublists){

$gearitems = get_post_meta( get_the_ID(), $sublist );
$gesamtgewicht = 0;
?>
<h3><?php echo $sublist; ?><a href="<?php echo $permalinkmain . '?removesublist=' . $sublist; ?>" class="hide-for-print"><i class="fa fa-times" style="float:right;"></i></a></h3>
<?php 
if ( !empty($gearitems) ):
 ?>
<table style="width: 100%;">
<?php
	foreach ($gearitems as $value):
		$einzelgewicht = get_post_meta( $value, 'gearlist_weight', true);
		$row = '';
		$row .= '<tr>';
		$row .= '<td>' . get_the_title( $value ) . '</td>';
		$row .= '<td>'. drag_dropdown($post_ID, $value, $allsublists, $sublist, $permalinkmain) .'</td>';
		$row .= '<td style="text-align:right">' . get_post_meta( $value, 'gearlist_weight', true) . 'g</td>';
		$row .= '<td class="hide-for-print"><a href="' . $permalinkmain . '?removegear=' . $value . '&removegearsublist=' . $sublist . '">';
		$row .= '<span class="round alert label">löschen</span></a></td>';
		$row .= '</tr>';
		echo $row;
		$gesamtgewicht = $gesamtgewicht + $einzelgewicht;
	endforeach;
	?>
	<tr>
		<td><strong>Gesamt</strong></td>
		<td></td><!-- Platzhalter für "Verschieben" Button, den es in der Gesamt Zeile nicht gibt -->
		<td style="text-align:right"><strong><?php echo $gesamtgewicht; ?>g</strong></td>
		<td class="hide-for-print"></td>
	</tr>
	</table>
<?php 
else:
	echo $sublist . ' wurden noch keine Elemente zugewießen<br /><br />';
endif; 

}





function drag_dropdown($post_ID, $item_ID, $allsublists, $current_sublist, $permalinkmain){ //Verschieben Funktion zwischen Sublists
/*
	Funktionserklärung:
	Schritt 1: Element wird aus aktueller Liste Gelöscht
	Schritt 2: Element wird der neuen Liste hinzugefügt
*/

	$output = '';
	$output .= '<button href="#" data-dropdown="drop-drag-' . $item_ID . '" aria-controls="drop-drag-' . $item_ID . '" aria-expanded="false" class="button tiny dropdown">Verschieben</button><br>';
	$output .= '<ul id="drop-drag-' . $item_ID . '" data-dropdown-content class="f-dropdown" aria-hidden="true">';

	foreach ($allsublists as $value){
		if ($value != $current_sublist) {
			$output .= '<li><a href="' . $permalinkmain . '?removegear=' . $item_ID . '&removegearsublist=' . $current_sublist . '&addgear=' . $item_ID . '&sublist=' . $value . '">';
			$output .= $value;
			$output .= '</a></li>';
		}

 	}

 	$output .= '</ul>';
 	return $output;
}
