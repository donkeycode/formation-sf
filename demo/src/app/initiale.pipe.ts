import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'initiale'
})
export class InitialePipe implements PipeTransform {

  transform(value: string): string {
    return value[0];
  }

}
