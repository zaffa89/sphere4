import{d as l,W as d,o as z,e as g,f as t,u as a,w as c}from"./app.a38ae4b2.js";import{D as _,a as x,c as i,h as v,j as b,k as D}from"./data-grid.6a366d3a.js";import{D as y}from"./select-box.2bb2ce3f.js";import{b4 as u,b5 as E}from"./check_box.c2296870.js";import"./select_box.ea1db3ab.js";import"./date_box.4cf84eb9.js";import"./number_box.417c871a.js";import"./draggable.265766d8.js";const S=l("div",{class:"master-detail-caption"},"Prestazioni associate",-1),$={class:"flex my-3"},k={class:"w-full md:w-1/2"},P={class:"w-full md:w-1/2"},O={__name:"PrestazioniListinoAmbulatorialeTemplate",props:{templateData:Object},setup(m){const s=m,r=d(null),A=d(null),p=new u({key:"id",load:()=>axios.get("api/sphere/ambulatoriale/prestazione").then(e=>e.data).catch(e=>{throw new Error("Errore caricamento")}),errorHandler:e=>{console.log(e.message)}}),n={store:new u({key:"id",load:()=>axios.get(`api/sphere/ambulatoriale/prestazioni-listino/${s.templateData.data.id}`).then(e=>e.data).catch(e=>{throw new Error("Errore caricamento")}),insert:e=>axios.post(`api/sphere/ambulatoriale/prestazioni-listino/add/${s.templateData.data.id}/${e}`).then(o=>o.data).catch(o=>{throw new Error("Errore caricamento")}),remove:e=>axios.delete(`api/sphere/ambulatoriale/prestazioni-listino/remove/${s.templateData.data.id}/${e}`),errorHandler:e=>{console.log(e.message)},onPush:e=>{axios.post(`api/sphere/ambulatoriale/prestazioni-listino/add/${s.templateData.data.id}/${e[0].data.id}`).then(o=>o.data).catch(o=>{throw new Error("Errore caricamento")})}}),reshapeOnPush:!0};function h(){r.value&&(n.store.push([{type:"insert",data:r.value,index:-1}]),r.value=null)}function w(e){return e?'<div class="flex gap-2"><span class="truncate capitalize w-1/5">'+e.codice+'</span> <span class="uppercase">'+e.nome+"</span></div>":"<div />"}return(e,o)=>(z(),g("div",null,[S,l("div",$,[l("div",k,[t(a(y),{modelValue:r.value,"onUpdate:modelValue":o[0]||(o[0]=f=>r.value=f),"search-enabled":!0,"data-source":a(p),"search-mode":"contains","search-expr":["codice","nome"],"search-timeout":100,"show-data-before-search":!0,"display-expr":"nome",placeholder:"Seleziona una prestazione da associare a questa visita","item-template":w},null,8,["modelValue","data-source"])]),l("div",P,[t(a(E),{width:"100%",text:"Aggiungi",type:"success",icon:"Aggiungi","styling-mode":"outlined",disabled:!r.value,onClick:h},null,8,["disabled"])])]),t(a(_),{"data-source":n,"show-borders":!0,"allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!0,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!0,"show-row-lines":!0,"hover-state-enabled":!0,width:"100%"},{default:c(()=>[t(a(x),{mode:"single"}),t(a(i),{"data-field":"id","allow-editing":!1}),t(a(i),{"data-field":"codice"}),t(a(i),{"data-field":"nome"}),t(a(i),{"data-field":"durata","allow-editing":!1}),t(a(i),{"data-field":"prezzo"}),t(a(v),{mode:"row","allow-deleting":!0}),t(a(b),{"recalculate-while-editing":!0},{default:c(()=>[t(a(D),{column:"prezzo","summary-type":"sum","display-format":"Prezzo totale prestazioni associate \u20AC {0}","show-in-column":"prezzo"})]),_:1})]),_:1})]))}};export{O as default};