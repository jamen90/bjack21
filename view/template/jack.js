		var VALUE = [2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, 11];
var CARDS = ["2","3","4","5","6","7","8","9","10","jack","queen","king","ace"];
var TYPES = ["hearts.png", "clubs.png", "diamonds.png", "spades.png"];

var onHand = [];
var pCards = [];
var dCards = [];
var pHand;
var dHand;
var bet = 0;
var state = "";
var sc;

function sumup()
{
	pHand = 0;
	dHand = 0;

	var ace = false;
	var acc = 0;
	for( i =0; i < pCards.length; ++i)
	{
		if(pCards[i].startsWith('a'))
		{
			ace = true;
			acc += 1;
		}
		for(j=0; j < CARDS.length; ++j)
		{

			if(pCards[i].startsWith(CARDS[j][0]))
			{
				pHand += VALUE[j]
			}
		}

	}
	if(ace==true)
	{
		for(i=1; i<=acc; i++)
		{
			if(pHand>21)
			{
				pHand -= 10;
			}
		}
	}

	var ace2 = false;
	var acc2 = 0;
	for( i =0; i < dCards.length; ++i)
	{
		if(dCards[i].startsWith('a'))
		{
			ace2 = true;
			acc2 += 1;
		}
		for(j=0; j < CARDS.length; ++j)
		{

			if(dCards[i].startsWith(CARDS[j][0]))
			{
				dHand += VALUE[j]
			}
		}

	}
	if(ace2==true)
	{
		for(i=1; i<=acc2; i++)
		{
			if(dHand>21)
			{
				dHand -= 10;
			}
		}
	}

	rule(false);
	display();

}

function rule(final)
{
	if(pHand > 21){
		state = "Busted Hand:You Lose";
		sc = 0;
	}
	else if(dHand > 21){
		state = "You Win";
		sc =1;
	}
	else if (final == true)
	{
		if(pHand > dHand)
		{
			state = "You Win";
			sc=1;
		}
		else if(pHand < dHand)
		{
			state = "You Lose";
			sc=0;
		}
		else if (pHand == dHand)
		{
			state = "Push!";
		}
	}

}

function score(r)
{
	if(r == 1)
	{
		var f = document.createElement("form");
		f.action = "index.php?action=score";
		f.method = "POST";

		var v = document.createElement("input");
		v.type = 'hidden';
		v.name = 'bite';
		v.value = bet;

		f.appendChild(v);

		document.getElementById("hidden_v").appendChild(f);

		f.submit();
	}
	else if(r == 0)
	{
		var f = document.createElement("form");
		f.action = "index.php?action=score";
		f.method = "POST";

		var v = document.createElement("input");
		v.type = 'hidden';
		v.name = 'bite';
		v.value = bet - (bet*2);

		f.appendChild(v);

		document.getElementById("hidden_v").appendChild(f);

		f.submit();
	}

}

function hit()
{	
	var again = true;
	do
	{
		var c = CARDS[getcard(0,CARDS.length)]+"_of_"+TYPES[getcard(0,4)];
		if(onHand.includes(c)==false)
		{
			again = false;
		}
		else
		{
			var c ="";
		}
	}while(again==true);
	pCards.push(c);
	onHand.push(c);

	sumup();
	
}

function stand()
{
	while(dHand < 18)
	{
		if(dHand > pHand)
		{
			break;
		}
		do
		{
			var c = CARDS[getcard(0,CARDS.length)]+"_of_"+TYPES[getcard(0,4)];
		}while(onHand.includes(c));
		dCards.push(c);
		onHand.push(c);
		sumup();
	}
	rule(true);
	display();
}

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}


async function display()
{
	document.getElementById("dealer").innerHTML = "";
	document.getElementById("player").innerHTML = "";

	var D = document.getElementById("dealer");
	var cou;

	if(state!="")
	{
		cou = dCards.length;
	}
	else
	{
		cou = 1;
	}
	for(i = 0; i < cou; ++i)
	{
		var ca = document.createElement("img");
		ca.src = "view/static/png/"+dCards[i];
		ca.height = "170";
		ca.width = "80";
		D.appendChild(ca);
	}

	var P = document.getElementById("player");
	for(i = 0; i < pCards.length; ++i)
	{
		var cart = document.createElement("img");
		cart.src = "view/static/png/"+pCards[i];
		cart.height = "170";
		cart.width = "80";
		P.appendChild(cart);
	}

	if(state!="")
	{
		document.getElementById("stat").innerHTML = state;
		document.getElementById("dhand").innerHTML = dHand;
		document.getElementById("bet").innerHTML = "";
		score(sc)
		await sleep(2000);
		bet = 0;	
		game("end");


	}
	else
	{
		document.getElementById("dhand").innerHTML = "";
		document.getElementById("stat").innerHTML = "(-_-)";
	}
	
	document.getElementById("phand").innerHTML = pHand;
}

function game(where)
{
	if(where=="start")
	{
		document.getElementById("500").disabled = true;
		document.getElementById("100").disabled = true;
		document.getElementById("50").disabled = true;
		document.getElementById("10").disabled = true;
		document.getElementById("5").disabled = true;
		document.getElementById("1").disabled = true;
		document.getElementById("de").disabled = true;
		document.getElementById("hi").disabled = false;
		document.getElementById("st").disabled = false;

	}
	else if(where=="end")
	{
		document.getElementById("500").disabled = false;
		document.getElementById("100").disabled = false;
		document.getElementById("50").disabled = false;
		document.getElementById("10").disabled = false;
		document.getElementById("5").disabled = false;
		document.getElementById("1").disabled = false;
		document.getElementById("de").disabled = false;
		document.getElementById("hi").disabled = true;
		document.getElementById("st").disabled = true;

	}
}

function betmore(amount)
{
	bet += amount;
	display_bet();
}

function display_bet()
{
	document.getElementById("bet").innerHTML = bet;	
}


function deal()
{


	if(state!="")
	{
		onHand = [];
		pCards = [];
		dCards = [];
		pHand = 0;
		dHand = 0;
		state = "";
	}

	if(bet==0)
	{
		alert('You should bet, dude!');
	}
	else
	{
		game("start");
	

		for(i = 0 ; i < 2; ++i)
		{
			do
			{
				var c = CARDS[getcard(0,CARDS.length)]+"_of_"+TYPES[getcard(0,4)];
			}while(onHand.includes(c));
			pCards.push(c);
			onHand.push(c);
		}

		for(i = 0 ; i < 2; ++i)
		{
			do
			{
				var c = CARDS[getcard(0,CARDS.length)]+"_of_"+TYPES[getcard(0,4)];
			}while(onHand.includes(c));
			dCards.push(c);
			onHand.push(c);
		}

		sumup();

	}
}

function getcard(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}