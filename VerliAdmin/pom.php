<META http-equiv="Content-Type" content="Text/HTML; Charset=Windows-1250">
<?
Set_Time_Limit(600);
?>
<FONT size="-1">
<B>Z9-I-1 - Exkluzivn� ��sla :</B><BR>
Dvojm�stn� ��slo se naz�v� exkluzivn�, jestli�e m� n�sleduj�c�
vlastnost: ��slice exkluzivn�ho ��sla navz�jem vyn�sob�me, po p�i�ten�
sou�tu v�ech ��slic exkluzivn�ho ��sla k p�edchoz�mu v�sledku z�sk�me toto
exkluzivn� ��slo. Nap��klad 79 je exkluzivn�, nebo� 79 = 7*9+(7+9).
Najd�te v�echna exkluzivn� ��sla.<BR><BR>
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

<B>Z9-I-2 - �esti�heln�k :</B><BR>
Uvnit� pravideln�ho �esti�heln�ka o stran� d�lky 2*(3^1/2) cm se pohybuje
kruh o pr�m�ru 1 cm tak, �e se st�le pohybuje kruh tak �e se st�le
dot�k� obvodu pravideln�ho �esti�heln�ku. Vypo��tejte obsah t� ��sti
�esti�heln�ku, kter� nem��e b�t nikdy p�ekryta pohybuj�c�m se kruhem.<BR><BR>
<FONT color="blue">
<?

?>
</FONT>

<BR><BR>

<B>Z9-I-3 - V�b�r ��sel :</B><BR>
Kolika zp�soby lze vybrat 7 ��sel z mno�iny  {1,2,...,8,9} tak, aby jejich
sou�et byl d�liteln� t�emi.<BR><BR>
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

<B>Z9-I-4 - Kruh a �tverec :</B><BR>
Jsou d�ny kruh a �tverec se stejn�m obsahem. Do dan�ho kruhu vep�eme
�tverec, do dan�ho �tverce vep�eme kruh. Kter� z vepsan�ch obrazc�
m� vy��� obsah?<BR><BR>
<FONT color="blue">
<?

?>
</FONT>

<BR><BR>

<B>Z9-I-5 - Ove�ky :</B><BR>
Pan Sud� m�l sud� po�et ove�ek, pan Lich� lich� po�et ove�ek. Po�et v�ech
ove�ek dohromady tvo�il trojm�stn� ��slo, kter� m�lo v�echny ��slice
stejn�. Ka�d� ove�ce pana Sud�ho se narodily t�i ove�ky, ka�d� ove�ce
pana Lich�ho dv� ove�ky. Jednoho dne v�ak vlk zad�vil t�i ove�ky panu
Sud�mu. Te� m� pan Sud� stejn� velk� st�do jako pan Lich�. Kolik ove�ek
m�l p�vodn� ka�d� z chovatel�?<BR><BR>
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
P�t d�t� postupn� ��k�: "V�era bylo pond�l�." "Dnes je �tvrtek." "Poz�t��
bude p�tek." "Z�tra bude sobota." "P�edev��rem bylo �ter�." Pokud byste
v�d�li, kolik d�t� lhalo, hned by bylo jasn�, kter� den pr�v� je. Ur�ete,
kter� je tedy den?<BR><BR>
<FONT color="blue">
�tvrtek
</FONT>


</FONT>
