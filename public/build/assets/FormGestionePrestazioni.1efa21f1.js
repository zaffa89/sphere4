import{aj as A,ak as L,b as s,at as f,au as _,o as l,k as n,F as x,p as v,s as m,c as z,t as y,v as k,l as a,u as t,w as c,y as p}from"./app.91faff10.js";import{D as h,a as g,c as r,h as w,i as D}from"./data-grid.93ce6c9b.js";import F from"./PrestazioniListinoMedsportTemplate.6162d8ec.js";import N from"./PrestazioniListinoAmbulatorialeTemplate.1e576689.js";import{b4 as b}from"./check_box.bd4929f9.js";import{_ as B}from"./plugin-vue_export-helper.21dcd24c.js";import"./select_box.e8817efd.js";import"./date_box.745fde92.js";import"./number_box.976ffa07.js";import"./draggable.67b3fe5e.js";import"./select-box.9cc7c130.js";const u=d=>(A("data-v-449875ee"),d=d(),L(),d),G={class:"h-full overflow-y-auto"},H={class:"fixed top-20 bg-white rounded border"},I=u(()=>s("div",{class:"border-b px-2 py-2 text-center"},"Medicina dello sport",-1)),V={class:"space-y-1 w-60 mb-5"},j=["onClick"],O={class:"truncate"},R=u(()=>s("div",{class:"border-b px-2 py-2 text-center"},"Ambulatoriale",-1)),q={class:"space-y-1 w-60"},J=["onClick"],K={class:"truncate"},Q={class:"ml-64 p-6 bg-white rounded-md"},U={key:0},W=u(()=>s("p",{class:"text-md font-medium text-gray-800"},"Listino Medicina dello Sport",-1)),X={key:1},Y=u(()=>s("p",{class:"text-md font-medium text-gray-800"},"Prestazioni Medicina dello Sport",-1)),Z={key:2},ee=u(()=>s("p",{class:"text-md font-medium text-gray-800"},"Listino Ambulatoriale",-1)),te={key:3},ae=u(()=>s("p",{class:"text-md font-medium text-gray-800"},"Prestazioni Ambulatoriali",-1)),re={data(){return{currentTab:null}},methods:{changeTab(d){this.currentTab=d}}},oe=Object.assign(re,{__name:"FormGestionePrestazioni",setup(d){const E=[{name:"Listino",icon:f,tab:"ms-listino"},{name:"Prestazioni",icon:_,tab:"ms-prestazioni"}],T=[{name:"Listino",icon:f,tab:"ambu-listino"},{name:"Prestazioni",icon:_,tab:"ambu-prestazioni"}],S=new b({key:"id",load:()=>axios.get("api/sphere/medsport/listino").then(e=>e.data).catch(e=>{throw new Error("Errore caricamento")}),insert:e=>axios.post("api/sphere/medsport/listino",e).then(o=>o.data).catch(o=>{throw new Error("Errore caricamento")}),update:(e,o)=>axios.put(`api/sphere/medsport/listino/${e}`,o),remove:e=>axios.delete(`api/sphere/medsport/listino/${e}`),errorHandler:e=>{console.log(e.message)}}),$=new b({key:"id",load:()=>axios.get("api/sphere/medsport/prestazione").then(e=>e.data).catch(e=>{throw new Error("Errore caricamento")}),insert:e=>axios.post("api/sphere/medsport/prestazione",e).then(o=>o.data).catch(o=>{throw new Error("Errore caricamento")}),update:(e,o)=>axios.put(`api/sphere/medsport/prestazione/${e}`,o),remove:e=>axios.delete(`api/sphere/medsport/prestazione/${e}`),errorHandler:e=>{console.log(e.message)}}),C=new b({key:"id",load:()=>axios.get("api/sphere/ambulatoriale/listino").then(e=>e.data).catch(e=>{throw new Error("Errore caricamento")}),insert:e=>axios.post("api/sphere/ambulatoriale/listino",e).then(o=>o.data).catch(o=>{throw new Error("Errore caricamento")}),update:(e,o)=>axios.put(`api/sphere/ambulatoriale/listino/${e}`,o),remove:e=>axios.delete(`api/sphere/ambulatoriale/listino/${e}`),errorHandler:e=>{console.log(e.message)}}),P=new b({key:"id",load:()=>axios.get("api/sphere/ambulatoriale/prestazione").then(e=>e.data).catch(e=>{throw new Error("Errore caricamento")}),insert:e=>axios.post("api/sphere/ambulatoriale/prestazione",e).then(o=>o.data).catch(o=>{throw new Error("Errore caricamento")}),update:(e,o)=>axios.put(`api/sphere/ambulatoriale/prestazione/${e}`,o),remove:e=>axios.delete(`api/sphere/ambulatoriale/prestazione/${e}`),errorHandler:e=>{console.log(e.message)}});return(e,o)=>(l(),n("div",G,[s("div",H,[I,s("nav",V,[(l(),n(x,null,v(E,i=>s("button",{key:i.tab,onClick:M=>e.changeTab(i.tab),class:m([e.currentTab===i.tab?"bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700":"border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900","w-full group border-l-4 px-3 py-2 flex items-center text-sm font-medium"])},[(l(),z(y(i.icon),{class:m([e.currentTab===i.tab?"text-teal-500 group-hover:text-teal-500":"text-gray-400 group-hover:text-gray-500","flex-shrink-0 -ml-1 mr-3 h-6 w-6"]),"aria-hidden":"true"},null,8,["class"])),s("span",O,k(i.name),1)],10,j)),64))]),R,s("nav",q,[(l(),n(x,null,v(T,i=>s("button",{key:i.tab,onClick:M=>e.changeTab(i.tab),class:m([e.currentTab===i.tab?"bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700":"border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900","w-full group border-l-4 px-3 py-2 flex items-center text-sm font-medium"])},[(l(),z(y(i.icon),{class:m([e.currentTab===i.tab?"text-teal-500 group-hover:text-teal-500":"text-gray-400 group-hover:text-gray-500","flex-shrink-0 -ml-1 mr-3 h-6 w-6"]),"aria-hidden":"true"},null,8,["class"])),s("span",K,k(i.name),1)],10,J)),64))])]),s("div",Q,[e.currentTab==="ms-listino"?(l(),n("div",U,[W,a(t(h),{"data-source":t(S),"show-borders":!0,"allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!1,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!1,"show-row-lines":!0,"hover-state-enabled":!0,width:"100%"},{masterDetailTemplate:c(({data:i})=>[a(F,{"template-data":i},null,8,["template-data"])]),default:c(()=>[a(t(g),{mode:"single"}),a(t(r),{"data-field":"id"}),a(t(r),{"data-field":"codice"}),a(t(r),{"data-field":"nome"}),a(t(r),{"data-field":"tipo_visita"}),a(t(r),{"data-field":"prezzo"}),a(t(r),{"data-field":"durata"}),a(t(r),{"data-field":"agonistico"}),a(t(r),{"data-field":"tracciato"}),a(t(r),{"data-field":"rtp"}),a(t(r),{"data-field":"tipo_scheda"}),a(t(w),{mode:"form","allow-updating":!0,"allow-adding":!0,"allow-deleting":!0}),a(t(D),{enabled:!0,template:"masterDetailTemplate"})]),_:1},8,["data-source"])])):p("",!0),e.currentTab==="ms-prestazioni"?(l(),n("div",X,[Y,a(t(h),{ref:"grigliaPrestazioniMedsport","data-source":t($),"allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!0,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!0,"show-row-lines":!0,"hover-state-enabled":!0,"show-borders":!0,width:"100%"},{default:c(()=>[a(t(g),{mode:"single"}),a(t(r),{"data-field":"id","allow-editing":!1}),a(t(r),{"data-field":"codice"}),a(t(r),{"data-field":"nome"}),a(t(r),{"data-field":"rimborso_asl",caption:"Rimborso ASL"}),a(t(r),{"data-field":"istat","allow-editing":!1}),a(t(r),{"data-field":"branca","allow-editing":!1}),a(t(r),{"data-field":"codice_siss","allow-editing":!1}),a(t(w),{mode:"form","allow-updating":!0,"allow-adding":!0,"allow-deleting":!0})]),_:1},8,["data-source"])])):p("",!0),e.currentTab==="ambu-listino"?(l(),n("div",Z,[ee,a(t(h),{"data-source":t(C),"show-borders":!0,"allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!1,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!1,"show-row-lines":!0,"hover-state-enabled":!0,width:"100%"},{masterDetailTemplate:c(({data:i})=>[a(N,{"template-data":i},null,8,["template-data"])]),default:c(()=>[a(t(g),{mode:"single"}),a(t(r),{"data-field":"id"}),a(t(r),{"data-field":"codice"}),a(t(r),{"data-field":"nome"}),a(t(r),{"data-field":"prezzo"}),a(t(r),{"data-field":"durata"}),a(t(r),{"data-field":"referto_ambulatoriale"}),a(t(r),{"data-field":"referto_cardiologia"}),a(t(r),{"data-field":"referto_fisioterapia"}),a(t(w),{mode:"form","allow-updating":!0,"allow-adding":!0,"allow-deleting":!0}),a(t(D),{enabled:!0,template:"masterDetailTemplate"})]),_:1},8,["data-source"])])):p("",!0),e.currentTab==="ambu-prestazioni"?(l(),n("div",te,[ae,a(t(h),{"data-source":t(P),"allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!0,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!0,"show-row-lines":!0,"hover-state-enabled":!0,"show-borders":!0,width:"100%"},{default:c(()=>[a(t(g),{mode:"single"}),a(t(r),{"data-field":"id","allow-editing":!1}),a(t(r),{"data-field":"codice"}),a(t(r),{"data-field":"nome"}),a(t(r),{"data-field":"durata","allow-editing":!1}),a(t(r),{"data-field":"prezzo"}),a(t(w),{mode:"form","allow-updating":!0,"allow-adding":!0,"allow-deleting":!0})]),_:1},8,["data-source"])])):p("",!0)])]))}});var we=B(oe,[["__scopeId","data-v-449875ee"]]);export{we as default};
