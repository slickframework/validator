# Changelog

All Notable changes to `Slick/validator` will be documented in this file.


## 1.1.0 - 2016-02-02

### Added
- ValidatorInterface::validates() with is more semantic and accepts context
- ValidationChainInterface interface and ValidationChain class

### Deprecated
- ChainInterface interface and ValidatorChain class. Replaced by ValidationChainInterface
  ValidationChain. New methods where added in order to deal with single message in the
  new ValidatorInterface.
- ValidatorInterface::isValid(). This is not so verbose as the new
  ValidatorInterface::validates() that should be used.
  
### Removed
- Multiple messages per validator. It was a feature that was never used 

## 1.0.4 - 2016-01-30

### Added
- Released as a separate package  