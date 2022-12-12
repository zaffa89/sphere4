/* NON ESPORTARE , COPIA E INCOLLA NEL COMPONENTE COME METODO */

export function errorFor(field){  
    return null !== this.errors && this.errors[field]
        ? true 
        : null;
  }