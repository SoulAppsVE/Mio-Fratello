<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="border-radius: 0px !important; top: 50px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Finalizar Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
		  <div class="form-group" style="background-color: #f8fad6; padding: 50px;">
		  	<div class="row">
		  		<div class="col-md-6">
			    	<label>Pago</label>
			    	<input type="text" v-model="paid" class="form-control" style="border-radius: 0px !important;">
		    	</div>

		    	<div class="col-md-6">
			    	<label>Forma de Pago</label>
			    	<select class="form-control" v-model="paying_method" style="border-radius: 0px !important;">
			    		<option value="cash">{{trans('core.cash')}}</option>
					  	<option value="card">{{trans('core.card')}}</option>
					  	<option value="cash + card">{{trans('core.cash-plus-card')}}</option>
					  	<option value="mobile_money">{{trans('core.mobile-money')}}</option>
					  	<option value="others">{{trans('core.others')}}</option>
			    	</select>
		    	</div>
			</div>
            <!--<div class="row" v-if="paying_method != 'cash'">-->
			<div class="row" >
		  		<div class="col-md-12">
			    	<label>Referencia / Nota</label>
			    	<input type="text" v-model="reference_no" class="form-control" style="border-radius: 0px !important;">
		    	</div>
			</div>
		  </div>

		  <hr>

		  <table class="table table-bordered" style="background-color: #f9f9f9;">
		  	<tr style="font-size: 25px;">
		  		<td width="20%">Total Items : </td>
		  		<td width="15%"> @{{totalQuantity}}</td>
		  		<td width="25%">Total por Pagar : </td>
		  		<td width="40%">@{{ parseFloat(netTotal).toFixed(2) }} $ / @{{ formatPrice(netTotal * dolar) }} Bs</td>
		  	</tr>

		  	<!-- <tr>
		  		<td width="25%">Due : </td>
		  		<td width="25%"> 
		  			<span v-if="(netTotal - paid) >= 0">@{{netTotal - paid}}</span>
		  			<span v-else>0</span>
		  		</td>
		  		<td  width="25%">Change Amount : </td>
		  		<td  width="25%"> 
		  			<span v-if="(paid - netTotal) >= 0">@{{paid - netTotal}}</span>
		  			<span v-else>0</span>
		  		</td>
		  	</tr> -->
		  </table>
		  <span style="color: red; font-size: 25px; font-weight: bolder;">
		  		Deuda: 
		  		<span v-if="(netTotal - paid) >= 0">@{{ parseFloat(netTotal- paid).toFixed(2)}}</span>
		  		<span v-else>0</span>
		  </span>
		  <br>
		  <span style="color: green; font-size: 25px; font-weight: bolder;" >
		  	    Cambio: 
			  	<span v-if="(paid - netTotal) >= 0">@{{ parseFloat(paid - netTotal).toFixed(2)  }}</span>
			  	<span v-else>0</span>
		  </span>
      </div>
      <div class="modal-footer">
      	<button  class="btn btn-primary btn-block" @click.prevent="postSell" >
      		Pagar
      	</button>
      </div>
    </div>
  </div>
</div>