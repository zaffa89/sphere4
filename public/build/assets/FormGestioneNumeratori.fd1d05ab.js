import{p as m,b as c,d,o as u,e as _,f as e,u as t,w as s}from"./app.d1109b7e.js";import{D as p,a as f,c as r,h,i as w}from"./data-grid.23300702.js";import g from"./DettagliNumeratoreTemplate.4cae5745.js";import{b4 as x}from"./check_box.f0a19422.js";import{_ as b}from"./plugin-vue_export-helper.21dcd24c.js";import"./select_box.12d15f3d.js";import"./date_box.7abd4f86.js";import"./number_box.9a624177.js";import"./draggable.d22a0d73.js";import"./select-box.564c7aaa.js";const D=o=>(m("data-v-bdd38d46"),o=o(),c(),o),v={class:"h-full overflow-y-auto"},E={class:"p-6 bg-white rounded-md"},N=D(()=>d("p",{class:"text-md font-medium text-gray-800"},"Numeratori",-1)),S={data(){return{currentTab:null}},methods:{changeTab(o){this.currentTab=o}}},y=Object.assign(S,{__name:"FormGestioneNumeratori",setup(o){const l=new x({key:"id",load:()=>axios.get("api/sphere/numeratore").then(a=>a.data).catch(a=>{throw new Error("Errore caricamento")}),insert:a=>axios.post("api/sphere/numeratore",a).then(i=>i.data).catch(i=>{throw new Error("Errore caricamento")}),errorHandler:a=>{console.log(a.message)}});return(a,i)=>(u(),_("div",v,[d("div",E,[N,e(t(p),{"data-source":t(l),"show-borders":!0,"allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!1,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!1,"show-row-lines":!0,"hover-state-enabled":!0,width:"100%"},{masterDetailTemplate:s(({data:n})=>[e(g,{"template-data":n},null,8,["template-data"])]),default:s(()=>[e(t(f),{mode:"single"}),e(t(r),{"data-field":"id"}),e(t(r),{"data-field":"codice"}),e(t(r),{"data-field":"descrizione"}),e(t(r),{"data-field":"tipo"}),e(t(r),{"data-field":"suffisso"}),e(t(r),{"data-field":"automatico"}),e(t(r),{"data-field":"struttura_id"}),e(t(h),{mode:"form","allow-updating":!0,"allow-adding":!0,"allow-deleting":!0}),e(t(w),{enabled:!0,template:"masterDetailTemplate"})]),_:1},8,["data-source"])])]))}});var H=b(y,[["__scopeId","data-v-bdd38d46"]]);export{H as default};