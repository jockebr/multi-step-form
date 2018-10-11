<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Description of class-mondula-multistep-forms-block-numeric
 *
 * @author nico, marten
 */
class Mondula_Form_Wizard_Block_Numeric extends Mondula_Form_Wizard_Block {

	private $_label;
	private $_required;
	private $_minimum;
	private $_maximum;

	protected static $type = "fw-numeric";

	/**
	 * Creates an Object of this Class.
	 * @param string $label The Label the Object is being created with.
	 * @param boolean $required If true, Input for this field is required.
	 * @param integer $minimum Lower Threshold of Numeric Input.
	 * @param integer $maximum Upper Threshold of Numeric Input.
	 */
	public function __construct ($label, $required, $minimum, $maximum) {
		$this->_label = $label;
		$this->_required = $required;
		$this->_minimum = $minimum;
		$this->_maximum = $maximum;
	}

	/**
	 * Returns the '_required'-Status of the Object.
	 * @return boolean $_required If true, Input for this field is required.
	 */
	public function get_required() {
	  return $this->_required;
	}

	public function render( $ids ) {
	  ?>
		<div 
			class="fw-step-block" 
			data-blockId="<?php echo $ids[0]; ?>" 
			data-type="fw-numeric" 
			data-required="<?php echo $this->_required; ?>" 
			<?php if (strlen($this->_minimum) > 0) { echo 'data-min="' . $this->_minimum . '"'; } ?>
			<?php if (strlen($this->_maximum) > 0) { echo 'data-max="' . $this->_maximum . '"'; } ?>
		>

			<div class="fw-input-container">
				<h3><?php echo $this->_label ?></h3>
				<input 
					type="text" 
					class="fw-text-input" 
					data-id="numeric" 
					<?php if (strlen($this->_minimum) > 0) { echo 'min="' . $this->_minimum . '"'; } ?>
					<?php if (strlen($this->_maximum) > 0) { echo 'max="' . $this->_maximum . '"'; } ?>
				>
				<span class="fa fa-asterisk form-control-feedback" aria-hidden="true"></span>
			</div>
			<div class="fw-clearfix"></div>
		</div>
	  <?php
	}

	public function as_aa() {
		return array(
			'type' => 'numeric',
			'label' => $this->_label,
			'required' => $this->_required,
			'minimum' => $this->_minimum,
			'maximum' => $this->_maximum
		);
	}

	public static function from_aa($aa , $current_version, $serialized_version) {
		$label = $aa['label'];
		$required = $aa['required'];
		$minimum = $aa['minimum'];
		$maximum = $aa['maximum'];

		if (!ctype_digit(ltrim($minimum, '-'))) {
			$minimum = '';
		}

		if (!ctype_digit(ltrim($maximum, '-'))) {
			$maximum = '';
		}

		if (strlen($minimum) > 0 && strlen($maximum) > 0) {
			if (intval($minimum) >= intval($maximum)) {
				$maximum = strval(intval($minimum) + 1);
			}
		}

		return new Mondula_Form_Wizard_Block_Numeric($label, $required, $minimum, $maximum);
	}
}
