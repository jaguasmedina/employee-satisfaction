import { Component } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { FavoritesComponent } from './components/favorites/favorites.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'tumipay';
  constructor(public dialog: MatDialog) {}

  openFavorites(): void {
    this.dialog.open(FavoritesComponent, {
      width: '600px'
    });
  }
}
