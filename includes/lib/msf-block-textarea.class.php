<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Representation of a textarea input field.
 *
 * @author alex
 */
class Mondula_Form_Wizard_Block_Textarea extends Mondula_Form_Wizard_Block {

	private $_label;
	private $_required;

	protected static $type = "fw-textarea";

	/**
	 * Creates an Object of this Class.
	 * @param string $label The Label the Object is being created with.
	 * @param boolean $required If true, Input for this field is required.
	 */
	public function __construct ( $label, $required ) {
		$this->_label = $label;
		$this->_required = $required;
	}

	/**
	 * Returns the '_required'-Status of the Object.
	 * @return boolean $_required If true, Input for this field is required.
	 */
	public function get_required( ) {
	  return $this->_required;
	}

	// TODO: add text field label variable and ids
	public function render( $ids ) {
		?>
		<div class="fw-step-block" data-blockId="<?php echo $ids[0]; ?>" data-type="fw-textarea" data-required="<?php echo $this->_required; ?>">
			<div class="fw-input-container">
				<h3><?php echo $this->_label ?></h3><textarea class="fw-textarea" data-id="textarea"></textarea><span class="fa fa-pencil t-area form-control-feedback" aria-hidden="true"></span>
			</div>
			<div class="fw-clearfix"></div>
		</div>
		<?php
	}

	// TODO fw-text render_mail
	public function render_mail ( $data ) {
		echo "Name: $data[name]" . PHP_EOL;
		echo "Email: $data[email]" . PHP_EOL;
	}

	public function as_aa() {
		return array(
			'type' => 'textarea',
			'label' => $this->_label,
			'required' => $this->_required
		);
	}

	public static function from_aa( $aa , $current_version, $serialized_version ) {
		$label = $aa['label'];
		$required = $aa['required'];
		return new Mondula_Form_Wizard_Block_Textarea( $label, $required );
	}
}
