import{ae as n,o as l,e as s,f as i,u as t,w as m,c as u,C as d}from"./app.e0b64a2d.js";import c from"./ModalAmbulatorio.f7ba14dc.js";import{D as b,a as p,b as h,c as a,d as f}from"./data-grid.3cc08822.js";import{l as _}from"./check-box.76fadd22.js";import"./index.e824f945.js";import{_ as g}from"./plugin-vue_export-helper.21dcd24c.js";import"./response.70bff4ea.js";import"./check_box.9d1619d3.js";import"./select-box.44b95513.js";import"./select_box.f7ade88d.js";import"./number-box.60e27d35.js";import"./number_box.9ca8c8f2.js";import"./text-area.2fa8fbc0.js";import"./date_box.af268e83.js";import"./draggable.facd0f82.js";const w={emits:["notify"],data(){return{fetching:!1,modal_ambulatorio_id:null,ricerca:null,errors:null,ambulatori:[]}},computed:{disabledElement(){return this.fetching}},async created(){_("it-IT"),await axios.get("api/sphere/ambulatorio").then(o=>{this.ambulatori=o.data})},methods:{timezoneFixer(o){return n(o.value)},ambulatorioSalvato(o){this.ambulatori.push(o),this.$refs.griglia.instance.refresh(),this.$emit("notify","success","Ambulatorio salvato con successo"),this.modal_ambulatorio_id=null},async ambulatorioModificato(o){await axios.get("api/sphere/ambulatorio").then(e=>{this.ambulatori=e.data}),this.$emit("notify","success","Ambulatorio modificato con successo"),this.modal_ambulatorio_id=null},errorFor(o){return!!(this.errors!==null&&this.errors[o])},onRowPrepared(o){o.rowElement.className+=" hover:bg-gray-300"},openContextMenu(o){o.row&&this.$refs.griglia.instance.selectRows([o.row.key]),o.items=[{visible:o.rowIndex>-1,text:"Apri",icon:"showpanel",onItemClick:()=>{this.apriAmbulatorio(o.row.data.id)}},{visible:o.rowIndex>-1,text:"Elimina",icon:"trash",onItemClick:()=>{this.confermaEliminaAmbulatorio(o.rowIndex)}},{text:"Nuovo",icon:"plus",onItemClick:()=>{this.nuovoAmbulatorio()}}]},aggiornaRiga(o){},onRowDblClick(o){this.apriAmbulatorio(o.data.id)},confermaEliminaAmbulatorio(o){this.$refs.griglia.instance.option({"editing.texts.confirmDeleteMessage":"Sei sicuro di voler eliminare l'ambulatorio selezionato?"}),this.$refs.griglia.instance.deleteRow(o)},deleteAmbulatorio(o){o.cancel=axios.delete(`api/sphere/ambulatorio/${o.data.id}`).then(e=>(this.$emit("notify","success","Ambulatorio eliminato"),!1)).catch(e=>(this.$emit("notify","error","Errore","Eliminazione fallita"),!0))},nuovoAmbulatorio(){this.modal_ambulatorio_id="new"},apriAmbulatorio(o){this.modal_ambulatorio_id=o},async ricercaAmbulatorio(){this.fetching=!0,await axios.post("api/sphere/ricerca-ambulatorio",{ricerca:this.ricerca}).then(o=>{this.ambulatori=o.data}).catch(o=>{}),this.fetching=!1}}},v=Object.assign(w,{__name:"FormAmbulatori",setup(o){return(e,r)=>(l(),s("div",null,[i(t(b),{id:"griglia",ref:"griglia","data-source":e.ambulatori,"key-expr":"id","allow-column-reordering":!0,"allow-column-resizing":!0,"column-auto-width":!1,"column-min-width":50,"column-resizing-mode":"widget","row-alternation-enabled":!0,"show-row-lines":!0,"hover-state-enabled":!0,onContextMenuPreparing:e.openContextMenu,onRowPrepared:e.onRowPrepared,onRowDblClick:e.onRowDblClick,onRowRemoving:e.deleteAmbulatorio},{default:m(()=>[i(t(p),{mode:"single"}),i(t(h),{enabled:!0}),i(t(a),{"data-field":"id"}),i(t(a),{"data-field":"nome",caption:"Nome ambulatorio"}),i(t(a),{"data-field":"struttura_id",caption:"Struttura"}),i(t(a),{"data-field":"attivo"}),i(t(a),{"data-field":"created_at","customize-text":e.timezoneFixer},null,8,["customize-text"]),i(t(a),{"data-field":"updated_at","customize-text":e.timezoneFixer},null,8,["customize-text"]),i(t(f),{mode:"infinite"})]),_:1},8,["data-source","onContextMenuPreparing","onRowPrepared","onRowDblClick","onRowRemoving"]),e.modal_ambulatorio_id?(l(),u(c,{key:0,"ambulatorio-id":e.modal_ambulatorio_id,onClose:r[0]||(r[0]=x=>e.modal_ambulatorio_id=null),onStore:e.ambulatorioSalvato,onUpdate:e.ambulatorioModificato},null,8,["ambulatorio-id","onStore","onUpdate"])):d("",!0)]))}});var B=g(v,[["__scopeId","data-v-3b100e3c"]]);export{B as default};
