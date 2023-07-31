import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import { AboutsComponent } from './abouts/abouts.component';
import { ProfilesComponent } from './profiles/profiles.component';
import { ServicesComponent } from './services/services.component';

@NgModule({
  declarations: [
    AppComponent,
    LandingComponent,
    AboutsComponent,
    ProfilesComponent,
    ServicesComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
