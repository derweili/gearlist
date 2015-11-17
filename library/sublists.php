<?php 

function sublistTable($post_ID, $sublist, $permalinkmain, $allsublists){

$gearitems = get_post_meta( $sublist, 'items' );

if (get_post_meta( $sublist, 'baseweight' ) != '') {
	$gesamtgewicht = get_post_meta( $sublist, 'baseweight' );
	$gesamtgewicht = $gesamtgewicht[0];
}else{
	$gesamtgewicht = 0;
}
?>

<?php 

//Headline
$output = '<h3 class="">' . get_the_title($sublist);
if (get_the_title() != 'Körper') {
	$output .= '<a href="' . $permalinkmain . '?removesublist=' . $sublist . '" class="hide-for-print"><i class="fa fa-trash-o" style="float:right;"></i></a>';
}

$output .= '<span style="">';
if(get_post_meta( $sublist, 'baseweight', true ) != ''){ 
	$output .= ' – ' . get_post_meta( $sublist, 'baseweight', true ) . 'g'; 
}
$output .= '</span></h3>';



if ( !empty($gearitems) ):
 ?>


<?php
$output .='<div class="sublistcontainer"><table style="width: 100%;">';
		
	$output .= "<tr><th>#</th><th>Name</th><th></th><th>Kategorie</th><th>Umpacken</th><th>Gewicht</th><th>Gesamt</th><th></th></tr>";

$bodyWeight = 0; $consumerGoodsWeight = 0; $equipmentWeight = $gesamtgewicht;

	foreach ($gearitems as $value):
		$einzelgewicht = get_post_meta( $value, 'gearlist_weight', true);
		$itemCount = get_post_meta( $sublist, $value . '-count', true);
		$itemWeight = get_post_meta( $value, 'gearlist_weight', true);
		$itemWeightSubtotal = $itemCount * $itemWeight;
		$itemType = wp_get_post_terms( $value, 'geartype');

		//for the statistic
		

		if (get_the_title($sublist) == 'Körper') {

			$bodyWeight = $bodyWeight + $itemWeightSubtotal;

		}else{

			if ($itemType[0]->slug == 'verbrauchsgueter') {
				$consumerGoodsWeight =  $consumerGoodsWeight + $itemWeightSubtotal;
			}else{
				$equipmentWeight = $equipmentWeight + $itemWeightSubtotal;
			}

		}


		$row = '';
		$row .= '<tr>';
		$row = '<td>' . $itemCount . '</td>';
		$row .= '<td>' . get_the_title( $value ) . '</td>';
		$row .= '<td class="hide-for-print" style="width:50px"><a href="' . $permalinkmain . '?increasegear=' . $value . '&increasegearsublist=' . $sublist . '"><i class="fa fa-plus"></i></a> <a href="' . $permalinkmain . '?reducegear=' . $value . '&reducegearsublist=' . $sublist . '"><i class="fa fa-minus"></i></a></td>'; // Geartype Name
		$row .= '<td>' . $itemType[0]->name . '</td>'; // Geartype Name
		$row .= '<td>'. drag_dropdown($post_ID, $value, $allsublists, $sublist, $permalinkmain, $itemCount) .'</td>';
		$row .= '<td style="text-align:right">' . $itemWeight . 'g</td>'; // Item Weight
		$row .= '<td style="text-align:right">' . $itemWeightSubtotal . 'g</td>'; // Item Weight Subtotal (Weight * Count)
		$row .= '<td class="hide-for-print" style="width: 13px"><a href="' . $permalinkmain . '?removegear=' . $value . '&removegearsublist=' . $sublist . '">'; //Remove Item
		$row .= '<i class="fa fa-trash-o"></i></a></td>';
		$row .= '</tr>';
		
		$output .= $row;
		
		$gesamtgewicht = $gesamtgewicht + $itemWeightSubtotal;

		endforeach;
		
	$output .=	'<tr>';
	$output .=	'<td></td>';
	$output .=	'<td><strong>Gesamt</strong></td>';
	$output .=	'<td></td>';
	$output .=	'<td></td><!-- Platzhalter für "Verschieben" Button, den es in der Gesamt Zeile nicht gibt -->';
	$output .=	'<td></td>';
	$output .=	'<td></td>';
	$output .=	'<td style="text-align:right"><strong>' . $gesamtgewicht . 'g</strong></td>';
	$output .=	'<td class="hide-for-print"></td>';
	$output .=	'</tr>';
	$output .=	'</table>';
	$output .=	'</div>';

else:
	$output.= get_the_title( $sublist ) . ' wurden noch keine Elemente zugewießen<br /><br />';
endif;

if (!isset($consumerGoodsWeight)) {
	$consumerGoodsWeight = null;
}
if (!isset($bodyWeight)) {
	$bodyWeight = null;
}
if (!isset($equipmentWeight)) {
	$equipmentWeight = null;
}

$output = [
	'html' => $output,
	'consumerGoodsWeight' => $consumerGoodsWeight,
	'bodyWeight' => $bodyWeight,
	'equipmentWeight' => $equipmentWeight,
	'totalWeight' => $gesamtgewicht,
];
return $output;

}





function drag_dropdown($post_ID, $item_ID, $allsublists, $current_sublist, $permalinkmain, $itemCount){ //Verschieben Funktion zwischen Sublists
/*
	Funktionserklärung:
	Schritt 1: Element wird aus aktueller Liste Gelöscht
	Schritt 2: Element wird der neuen Liste hinzugefügt
*/

	$output = '';
	$output .= '<button href="#" data-dropdown="drop-drag-' . $item_ID . '" aria-controls="drop-drag-' . $item_ID . '" aria-expanded="false" class="button tiny dropdown">Umpacken</button><br>';
	$output .= '<ul id="drop-drag-' . $item_ID . '" data-dropdown-content class="f-dropdown" aria-hidden="true">';

	foreach ($allsublists as $value){
		if ($value != $current_sublist) {
			$output .= '<li><a href="' . $permalinkmain . '?removegear=' . $item_ID . '&removegearsublist=' . $current_sublist . '&addgear=' . $item_ID . '&addgearsublist=' . $value . '&addgearcount=' . $itemCount . '">';
			$output .= get_the_title($value);
			$output .= '</a></li>';
		}

 	}

 	$output .= '</ul>';
 	return $output;
}
