@props(['name','label'=>null,'type'=>'text','value'=>null,'attrs'=>[]])
<label class="form-label">{{ $label ?? ucwords(str_replace('_',' ',$name)) }}</label>
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name,$value) }}" {{ $attributes->merge(['class'=>'form-control'.($errors->has($name)?' is-invalid':'')]) }}>
@error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
