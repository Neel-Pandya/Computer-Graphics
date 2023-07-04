#include <stdio.h>
#include <conio.h>
#include <graphics.h>
#include <dos.h>

int main()
{
	int GD = DETECT, gm;
	initgraph(&GD, &gm, "c:\\turboc3\\bgi");

	/*	line(200,200,300,200);
 line(200,200,200,250);
 line(200,250,300,250);
  */
	int i = 1;
	while (!kbhit())
	{
		rectangle(200 + i, 200, 350 + i, 100);
		rectangle(100 + i, 120, 200 + i, 180);
		line(350 + i, 100, 400 + i, 150);
		line(400 + i, 150, 350 + i, 200);
		circle(200 + i, 230, 30);
		circle(350 + i, 230, 30);
		line(600, 0, 600, getmaxy());

		if (i == 200)
		{
			i = 1;
			rectangle(200 + i, 200, 350 + i, 100);
			rectangle(100 + i, 120, 200 + i, 180);
			line(350 + i, 100, 400 + i, 150);
			line(400 + i, 150, 350 + i, 200);
			circle(200 + i, 230, 30);
			circle(350 + i, 230, 30);
			line(600, 0, 600, getmaxy());
		}
		else
		{
			i++;
		}
		delay(10);
		cleardevice();
	}
	getch();
	closegraph();
	return 0;
}