<META http-equiv="Content-Type" content="Text/HTML; Charset=Windows-1250">
<?
Set_Time_Limit(600);
?>
<FONT size="-1">
<B>Z9-I-1 - Exkluzivní čísla :</B><BR>
Dvojmístné číslo se nazývá exkluzivní, jestliže má následující
vlastnost: Číslice exkluzivního čísla navzájem vynásobíme, po přičtení
součtu všech číslic exkluzivního čísla k předchozímu výsledku získáme toto
exkluzivní číslo. Například 79 je exkluzivní, neboť 79 = 7*9+(7+9).
Najděte všechna exkluzivní čísla.<BR><BR>
<FONT color="blue">
<?
$z = Array_Fill(10, 90, 0);

WHILE (List ($key, $val) = Each ($z)) {
	$x = SubStr($key, 0, 1);
	$y = SubStr($key, 1, 2);
	IF(($x * $y + $x + $y) == $key)
		$z[$key] = TRUE;
	ELSE
		UnSet($z[$key]);
	}

Print nl2br(Print_R($z, 1));
UnSet($z);
?>
</FONT>

<BR><BR>

<B>Z9-I-2 - Šestiúhelník :</B><BR>
Uvnitř pravidelného šestiúhelníka o straně délky 2*(3^1/2) cm se pohybuje
kruh o průměru 1 cm tak, že se stále pohybuje kruh tak že se stále
dotýká obvodu pravidelného šestiúhelníku. Vypočítejte obsah té části
šestiúhelníku, která nemůže být nikdy překryta pohybujícím se kruhem.<BR><BR>
<FONT color="blue">
<?

?>
</FONT>

<BR><BR>

<B>Z9-I-3 - Výběr čísel :</B><BR>
Kolika způsoby lze vybrat 7 čísel z množiny  {1,2,...,8,9} tak, aby jejich
součet byl dělitelný třemi.<BR><BR>
<FONT color="blue">
<?
$y = Array(
		1 => 1,
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9
		);

FOR($i = 1; $i <= 9; $i++) {
	FOR($x = 1; $x <= 9; $x++) {
		IF(!(($y[$i] + $y[$x]) % 3))
			{$z[$y[$i].' + '.$y[$x]] = TRUE;}
		}
	}

Print nl2br(Print_R($z, 1));
?>
</FONT>

<BR><BR>

<B>Z9-I-4 - Kruh a čtverec :</B><BR>
Jsou dány kruh a čtverec se stejným obsahem. Do daného kruhu vepíšeme
čtverec, do daného čtverce vepíšeme kruh. Který z vepsaných obrazců
má vyšší obsah?<BR><BR>
<FONT color="blue">
<?

?>
</FONT>

<BR><BR>

<B>Z9-I-5 - Ovečky :</B><BR>
Pan Sudý měl sudý počet oveček, pan Lichý lichý počet oveček. Počet všech
oveček dohromady tvořil trojmístné číslo, které mělo všechny číslice
stejné. Každé ovečce pana Sudého se narodily tři ovečky, každé ovečce
pana Lichého dvě ovečky. Jednoho dne však vlk zadávil tři ovečky panu
Sudému. Teď má pan Sudý stejně velké stádo jako pan Lichý. Kolik oveček
měl původně každý z chovatelů?<BR><BR>
<FONT color="blue">
<?
//$x sudy
//$y lichy

/*
FOR($x = 2; $x <= 998; $x + 2) {
	FOR($y = 1; $y <= 999; $y + 2) {
		IF(!(($x + $y) % 111) && $x + $y < 1000) {
			$x1 = $x * 3;
			$y1 = $y * 2;

			IF($x1 - 3 == $y) {
				Print $x." - ".$y;
				BREAK;
				}
			}
		}
	}
*/

FOR($n = 0;;$n++) {
	$i = (7 * $n - 3) / 222;
	IF($i < 9 && $i > 1) {
		$n = $n * 2 - 1;
		BREAK;
		}
	}

$k = ((3 * $n - 1) / 4) * 2;

Print "Pan lichy ma ".($n * 4)." ovecek <BR>";
Print "Pan sudy ma ".($k * 4)." ovecek";

//Print nl2br(Print_R($z, 1));
?>
</FONT>

<BR><BR>

<B>Z9-I-6 - Dny :</B><BR>
Pět dětí postupně říká: "Včera bylo pondělí." "Dnes je čtvrtek." "Pozítří
bude pátek." "Zítra bude sobota." "Předevčírem bylo úterý." Pokud byste
věděli, kolik dětí lhalo, hned by bylo jasné, který den právě je. Určete,
který je tedy den?<BR><BR>
<FONT color="blue">
čtvrtek
</FONT>


</FONT>
