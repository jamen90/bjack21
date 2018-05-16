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


function sumup()
{
	pHand = 0;
	dHand = 0;

	var ace = false;
	for( i =0; i < pCards.length; ++i)
	{
		if(pCards[i].startswith('a'))
		{
			ace = true;
		}
		for(j=0; j < CARDS.length; ++j)
		{

			if(pCards[i].startswith(CARDS[j][0]))
			{
				pHand += VALUE[j]
			}
		}

	}
	if(ace==true && pHand > 21)
	{
		pHand -= 10;
	}

	var ace2 = false;
	for( i =0; i < dCards.length; ++i)
	{
		if(dCards[i].startswith('a'))
		{
			ace2 = true;
		}
		for(j=0; j < CARDS.length; ++j)
		{

			if(dCards[i].startswith(CARDS[j][0]))
			{
				dHand += VALUE[j]
			}
		}

	}
	if(ace2==true && dHand > 21)
	{
		dHand -= 10;
	}
	rule(false);
	display();

}

function rule(final)
{
	if(pHand > 21){
		state = "You Lose";
	}
	else if(dHand > 21){
		state = "You Win";
	}
	else if (final == true)
	{
		if(pHand > dHand)
		{
			state = "You Win";
		}
		else
		{
			state = "You Lose";
		}
	}

}

function hit()
{	
	do
	{
		var c = CARDS[getcard(0,CARDS.length)]+"_of_"+TYPES[getcard(0,4)];
	}while(onHand.includes(c));
	pCards.push(c);
	onHand.push(c);

	sumup();
	
}

function stand()
{
	while(dHand < 17)
	{
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

function display()
{
	var D = document.getElementById("dealer");
	for(i = 0; i < dCards.length; ++i)
	{
		var ca = document.createElement("img");
		ca.src = "static/png/"+dCards[i];
		ca.height = "170";
		ca.width = "80";
		D.appendChild(ca);
	}

	var P = document.getElementById("player");
	for(i = 0; i < pCards.length; ++i)
	{
		var cart = document.createElement("img");
		cart.src = "static/png/"+pCards[i];
		cart.height = "170";
		cart.width = "80";
		P.appendChild(cart);
	}

	if(state!="")
	{
		document.getElementById("stat").innerHTML = state;
	}
	
}


function deal(b)
{
	if(b > 0){
		bet = b;
	}
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

function getcard(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}