{!! Form::model($setting, ['method' => 'post', 'files' => true]) !!}
	<div class="example-box-wrapper">
		<div class="form-horizontal bordered-row">

			<div class="form-group bg-khaki">
				<h3 class="control-label col-sm-2 title-hero">
		            {{trans('core.general_settings')}}
		        </h3>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">
					{{trans('core.shop_name')}}
				</label>
				<div class="col-sm-4 {{ $errors->has('site_name') ? 'has-error' : ''}}"> 
					{!! Form::text('site_name', $setting->site_name, ['class' => 'form-control']) !!}
					<!-- {!! $errors->first('site_name', '<p class="error-message">:message</p>') !!} -->
			    </div>

			    <label class="control-label col-sm-2">
			    	Tagline
			    </label>
				<div class="col-sm-4"> 
					{!! Form::text('slogan', $setting->slogan, ['class' => 'form-control']) !!}
			    </div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">
					{{trans('core.phone')}}
				</label>
				<div class="col-sm-4 {{ $errors->has('phone') ? 'has-error' : ''}}"> 
					{!! Form::text('phone', $setting->phone, ['class' => 'form-control']) !!}
			    </div>

			    <label class="control-label col-sm-2">
			    	{{trans('core.email')}}
			    </label>
				<div class="col-sm-4 {{ $errors->has('email') ? 'has-error' : ''}}"> 
					{!! Form::text('email', $setting->email, ['class' => 'form-control']) !!}
			    </div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">
					{{trans('core.shop_address')}}
				</label>
				<div class="col-sm-10 {{ $errors->has('address') ? 'has-error' : ''}}"> 
					{!! Form::textarea('address', $setting->address, ['class' => 'form-control', 'rows' => 3]) !!}
			    </div>
			</div>
			<div class="form-group">
                <label class="col-sm- control-label">
                	{{trans('core.logo')}}

                </label>
                <div class="col-sm-12" style="margin-top: 10px">
                    {!! Form::file('image', ['id' => 'file']) !!}
					<br>
					<small>
						El tamaño del logotipo debe ser (width=120px) x (height=40px).
					</small>
                </div>
            </div>
			<div class="form-group" style="visibility: hidden">
                <label class="control-label col-sm-2">
			    	{{trans('core.theme')}}
			    </label>
				<div class="col-sm-4"> 
					{!! Form::select('theme', [ 'bg-primary' => 'Pacific Blue', 'bg-green' => 'Green', 'bg-red' => 'Red', 'bg-blue' => 'Blue', 'bg-warning' => 'Orange', 'bg-purple' => 'Purple', 'bg-black' => 'Black','bg-gradient-1' => 'Moderate Azure', 'bg-gradient-2' => 'Strong Spring Green', 'bg-gradient-3' => 'Magenta-pink', 'bg-gradient-4' => 'Desaturated Cyan', 'bg-gradient-5' => 'Strong Azure', 'bg-gradient-6' => 'Vivid Cyan', 'bg-gradient-7' => 'Deep Cyan', 'bg-gradient-8' => 'Strong Cornflower Blue.', 'bg-gradient-9' => 'Strong Arctic Blue'], null, ['class' => 'form-control']) !!}
			    </div>

			    <label class="control-label col-sm-2">
			    	{{trans('core.dashboard_style')}}
			    </label>
				<div class="col-sm-4">
					{!! Form::select('dashboard_style', [ 'chart-box' => 'Chart Box', 'tile-box' => 'Tile Box'], $setting->dashboard, ['class' => 'form-control']) !!}
			    </div>
            </div>
			<div class="form-group" style="visibility: hidden">
				<label class="control-label col-sm-2">
				{{trans('core.enable_purchaser')}}
				</label>
				<div class="col-sm-4"> 
					{!! Form::select('enable_purchaser', ['0' => 'Disable', '1' => 'Enable'],null, ['class' => 'form-control']) !!}
			    </div>

			    <label class="control-label col-sm-2">
				{{trans('core.enable_customer')}}
				</label>
				<div class="col-sm-4"> 
					{!! Form::select('enable_customer', ['0' => 'Disable', '1' => 'Enable'],null, ['class' => 'form-control']) !!}
			    </div>
			</div>

			@if(auth()->user()->can('settings.manage'))
		    <div class="bg-default content-box text-center pad20A mrg25T" style="margin-top: 20px">
                <button class="btn btn-lg botom" type="submit">
                	{{ trans('core.save') }}
                </button>
            </div>
            @endif
		</div>		
	</div>
{!! Form::close() !!}