import { Component, OnInit } from '@angular/core';
import {Router} from '@angular/router';
import {CatActivityService} from '../services/cat-activity.service';

@Component({
  selector: 'app-add',
  templateUrl: './add.page.html',
  styleUrls: ['./add.page.scss'],
})
export class AddPage implements OnInit {

  constructor(private catActSV : CatActivityService ,private route:Router) { }
 
  ngOnInit() {
  }
  insert(form) {
    let his_name = form.his_name;
    let his_pirce = form.his_pirce;
   
    
    this.catActSV.insert(his_name, his_pirce).subscribe(
      
       );
       this.route.navigateByUrl("home");
       
  }

}
