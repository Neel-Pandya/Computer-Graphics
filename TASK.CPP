#include <stdio.h>
#include <conio.h>
#include <graphics.h>
#include <dos.h>
void main()
{
	int movI = 0;
	int movJ = 0;
	int i = 0;
	int j = 0;
	int gd = DETECT, gm;
	initgraph(&gd, &gm, "c:\\turboc3\\bgi");
	circle(100, 100, 30);
	while (!kbhit())
	{
		if (i == 500)
		{
			if (j == 300)
			{
				if (movI == 500)
				{
					if (movJ == 300)
					{
						i = 0;
						j = 0;
						movI = 0;
						movJ = 0;
					}
					else
					{
						cleardevice();
						circle(100, 400 - movJ, 30);
						delay(10);
						movJ++;
					}
				}
				else
				{
					cleardevice();
					circle(600 - movI, 400, 30);
					delay(10);
					movI++;
				}
			}
			else
			{
				cleardevice();
				circle(600, 100 + j, 30);
				delay(10);
				j++;
			}
		}
		else
		{
			cleardevice();
			circle(100 + i, 100, 30);
			delay(10);
			i++;
		}
	}

	getch();
}