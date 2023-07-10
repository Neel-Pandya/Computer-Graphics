
#include<stdio.h>
#include<conio.h>
#include<graphics.h>
#include<dos.h>

int main()
{
	int GD = DETECT ,gm;
	initgraph(&GD,&gm,"c:\\turboc3\\bgi");
	rectangle(100,50,600,450);
	line(350,50,350,450);     //between line
	line(100,250,600,250); //between horizontal
	line(150,100,250,100);
	//arrow
	line(150,100,150,130);
	line(150,130,250,130);
	line(250,100,250,80);
	line(250,80,300,115);
	line(250,130,250,150);
	line(300,115,250,150);
	settextstyle(3,0,1);
	outtextxy(200,200,"Arrow");

	//pentagon
       /*	line(475,100,460,130);
	line(460,130,475,180);
	line(475,180,500,180);
	line(475,100,500,130);
	line(500,130,500,180); */
	line(475,100,500,120);
	line(500,120,490,180);
	line(490,180,465,180);
	line(475,100,450,120);
	line(450,120,465,180);
	outtextxy(450,200,"Pentagon");

	//dimond
	line(475,300,450,340);
	line(450,340,480,380);
	line(480,380,510,340);
	line(510,340,475,300);
	outtextxy(450,400,"Diamond");

	//star
	line(150, 300, 175, 300);
    line(175, 300, 195, 260);
    line(195, 260, 220, 300);
    line(220, 300, 250, 300);
    line(250, 300, 220, 330);
    line(220, 330, 235, 370);
    line(235, 370, 190, 345);
    line(190, 345, 150, 380);
    line(150, 380, 170, 330);
    line(170, 330, 150, 300);
    outtextxy(180, 400, "Star");

				getch();
	closegraph();
}