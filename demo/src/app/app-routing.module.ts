import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { BooksComponent } from './books/books.component';
import { HomeComponent } from './home/home.component';
import { AdminGuard } from './admin-guard.guard';
import { LoginComponent } from './login/login.component';
import { BookComponent } from './book/book.component';


const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'books', component: BooksComponent, canActivate: [ AdminGuard ] },
  { path: 'login', component: LoginComponent },
  { path: 'books/:id', component: BookComponent },
  // { path: '**', component: NotFoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
